<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTradeController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $query = Trade::with('user');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $query->where('symbol', 'like', '%' . $request->q . '%');
        }

        return view('admin.trades', [
            'pageTitle' => 'Trades | Admin Panel',
            'statusFilter' => $request->status ?? 'all',
            'trades' => $query->latest()->paginate(30)->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('admin.trade-create', [
            'pageTitle' => 'Create Trade | Admin Panel',
            'users' => \App\Models\User::orderBy('name')->get(['id', 'name', 'email']),
            'assets' => collect($this->marketAssets()),
        ]);
    }

    protected function marketAssets(): array
    {
        return app(\App\Http\Controllers\DashboardController::class)->marketAssets();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'trading_asset_id' => ['required', 'integer'],
            'symbol' => ['nullable', 'string', 'max:30'],
            'name' => ['nullable', 'string', 'max:100'],
            'trade_type' => ['required', 'in:binary,spot,forex,crypto,stock'],
            'action' => ['required', 'in:buy,sell'],
            'amount' => ['required', 'numeric', 'min:1'],
            'leverage' => ['required', 'integer', 'min:1', 'max:500'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'demo' => ['nullable', 'boolean'],
        ]);

        $asset = collect($this->marketAssets())->firstWhere('id', (int) $data['trading_asset_id']);

        if (! $asset) {
            return back()->with('error', 'Selected asset is no longer available. Please pick another asset.')
                ->withInput();
        }

        $user = \App\Models\User::findOrFail($data['user_id']);
        $amount = (float) $data['amount'];
        $isDemo = $request->boolean('demo');

        if (! $isDemo && (float) $user->balance < $amount) {
            return back()->with('error', 'Insufficient balance for this user to place this trade.')
                ->withInput();
        }

        $customSymbol = $data['symbol'] ?? null;
        $customName = $data['name'] ?? null;
        $symbol = $customSymbol !== null && trim($customSymbol) !== ''
            ? strtoupper($customSymbol)
            : $asset['symbol'];
        $name = $customName !== null && trim($customName) !== '' ? $customName : $asset['name'];
        $custom = $customSymbol !== null && trim($customSymbol) !== '';

        $trade = \Illuminate\Support\Facades\DB::transaction(function () use ($user, $asset, $symbol, $name, $custom, $amount, $isDemo, $data) {
            if (! $isDemo) {
                $user->decrement('balance', $amount);
            }

            $trade = Trade::create([
                'user_id' => $user->id,
                'trading_asset_id' => $asset['id'],
                'symbol' => $symbol,
                'name' => $name,
                'asset_class' => $asset['asset_class'],
                'trade_type' => $data['trade_type'],
                'action' => $data['action'],
                'amount' => $amount,
                'leverage' => (int) $data['leverage'],
                'entry_price' => $custom ? $this->fakeEntryPrice($symbol) : (float) $asset['price'],
                'duration' => ($data['duration'] ?? null) !== null ? (int) $data['duration'] : null,
                'expires_at' => ($data['duration'] ?? null) !== null ? now()->addMinutes((int) $data['duration']) : null,
                'status' => 'open',
                'result' => 'pending',
                'is_demo' => $isDemo,
            ]);

            if (! $isDemo) {
                \App\Models\Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'debit',
                    'title' => 'Trade placed by admin: ' . $symbol . ' (' . $data['action'] . ')',
                    'amount' => $amount,
                    'status' => 'completed',
                    'reference' => 'TRD-ADMIN-' . mb_substr(strtoupper(\Illuminate\Support\Str::random(10)), 0, 20),
                'note' => $data['trade_type'] . ' · ' . $data['leverage'] . 'x leverage',
                ]);
            }

            return $trade;
        });

        $this->logActivity('trade.create', 'Trade', $trade->id,
            'Created ' . $data['trade_type'] . ' trade for ' . $user->name . ' on ' . $symbol
            . ' ($' . number_format($amount, 2) . ($isDemo ? ', demo' : ', live') . ')',
            ['user_id' => $user->id, 'symbol' => $symbol, 'amount' => $amount, 'demo' => $isDemo]);

        return redirect()->route('admin.trades')->with('success', 'Trade #' . $trade->id . ' created for ' . $user->name . '.');
    }

    public function show(Trade $trade)
    {
        $trade->load('user');

        return view('admin.trade-show', [
            'pageTitle' => 'Trade #' . $trade->id . ' | Admin Panel',
            'trade' => $trade,
        ]);
    }

    protected function fakeEntryPrice(string $symbol): float
    {
        $base = mb_strlen(trim($symbol)) > 0 ? (float) (array_sum(str_split(mb_strtolower(trim($symbol)))) / 2) + 100 : 100;

        return round($base + (rand(0, 1000) / 100), 2);
    }

    public function settle(Request $request, Trade $trade)
    {
        if ($trade->status === 'closed') {
            return back()->with('error', 'This trade is already settled.');
        }

        $data = $request->validate([
            'result' => ['required', 'in:win,loss'],
        ]);

        $pnl = round($trade->amount * $trade->leverage / 100, 2);
        $isWin = $data['result'] === 'win';

        $trade->pnl = $isWin ? $pnl : -$pnl;
        $trade->result = $data['result'];
        $trade->status = 'closed';
        $trade->closed_at = now();
        $trade->save();

        if (! $trade->is_demo) {
            $user = $trade->user;
            if ($isWin && $pnl > 0) {
                $user->increment('balance', $pnl);
                $user->increment('total_profit', $pnl);
            }
            Transaction::create([
                'user_id' => $trade->user_id,
                'type' => $isWin ? 'credit' : 'debit',
                'title' => 'Trade settled (' . $data['result'] . '): ' . $trade->symbol,
                'amount' => $isWin ? $pnl : $trade->amount,
                'status' => 'completed',
                'reference' => 'STL-' . strtoupper(Str::random(10)),
                'note' => $trade->trade_type . ' · ' . $trade->leverage . 'x leverage',
            ]);
        }

        $this->logActivity('trade.settle', 'Trade', $trade->id,
            'Settled trade #' . $trade->id . ' (' . $trade->symbol . ') as ' . $data['result']
            . ($isWin ? ' with P/L $' . number_format($pnl, 2) : ''),
            ['user_id' => $trade->user_id, 'symbol' => $trade->symbol, 'result' => $data['result'], 'pnl' => $isWin ? $pnl : -$pnl]);

        return back()->with('success', 'Trade #' . $trade->id . ' settled as ' . $data['result'] . '.');
    }
}