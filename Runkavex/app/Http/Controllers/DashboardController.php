<?php

namespace App\Http\Controllers;

use App\Models\BotSubscription;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseLesson;
use App\Models\CopyTrade;
use App\Models\Deposit;
use App\Models\InvestmentPlan;
use App\Models\Loan;
use App\Models\LoanPlan;
use App\Models\Market;
use App\Models\NftCategory;
use App\Models\NftCollection;
use App\Models\NftItem;
use App\Models\PreIpoHolding;
use App\Models\SignalPlan;
use App\Models\StockTrade;
use App\Models\SupportTicket;
use App\Models\Trade;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    protected ?array $allMarketsCache = null;

    protected function allMarkets(): array
    {
        return $this->allMarketsCache ??= Market::where('is_active', true)
            ->orderBy('id')
            ->get()
            ->map(fn (Market $m) => [
                'id' => $m->id,
                'name' => $m->name,
                'symbol' => $m->symbol,
                'price' => $m->price ?? '',
                'change' => $m->price_change ?? '',
                'class' => $m->class,
                'img' => $m->img,
            ])
            ->values()
            ->all();
    }

    protected function loanPlans(): array
    {
        return LoanPlan::where('is_active', true)
            ->orderBy('id')
            ->get()
            ->map(fn (LoanPlan $p) => [
                'id' => $p->id,
                'name' => $p->name,
                'description' => $p->description,
                'min_amount' => (float) $p->min_amount,
                'max_amount' => (float) $p->max_amount,
                'interest_rate' => (float) $p->interest_rate,
                'interest_type' => $p->interest_type,
                'min_duration' => (int) $p->min_duration,
                'max_duration' => (int) $p->max_duration,
                'processing_fee' => (float) $p->processing_fee,
                'min_account_balance' => (float) $p->min_account_balance,
                'requires_collateral' => (bool) $p->requires_collateral,
                'collateral_percentage' => $p->collateral_percentage !== null ? (float) $p->collateral_percentage : null,
            ])
            ->values()
            ->all();
    }

    protected function investmentPlans(): array
    {
        return InvestmentPlan::where('is_active', true)
            ->orderBy('min_amount')
            ->get()
            ->map(fn (InvestmentPlan $p) => [
                'name' => $p->name,
                'min' => (float) $p->min_amount,
                'max' => $p->max_amount !== null ? (float) $p->max_amount : null,
                'interest' => (float) $p->interest_rate,
                'duration' => (int) $p->duration,
                'interval' => 'Daily',
                'badge' => null,
            ])
            ->values()
            ->all();
    }

    public function markets(Request $request)
    {
        $class = $request->query('class');
        $search = trim((string) $request->query('search', ''));

        $all = $this->allMarkets();
        $items = $all;

        if ($class && $class !== 'all') {
            $items = array_values(array_filter($items, fn ($item) => $item['class'] === $class));
        }

        if ($search !== '') {
            $items = array_values(array_filter($items, fn ($item) => stripos($item['name'].' '.$item['symbol'], $search) !== false));
        }

        $counts = collect($all)->groupBy('class')->map->count();

        $withChanges = collect($all)
            ->filter(fn ($item) => $item['price'] !== '')
            ->map(fn ($item) => [
                'symbol' => $item['symbol'],
                'change' => (float) str_replace(['+', '%'], '', $item['change']),
                'changeRaw' => $item['change'],
            ])
            ->filter(fn ($item) => $item['change'] != 0);

        $topGainerItem = $withChanges->sortByDesc('change')->first();
        $topLoserItem = $withChanges->sortBy('change')->first();

        return view('dashboard.markets', [
            'active' => 'markets',
            'headerTitle' => 'Markets',
            'user' => Auth::user(),
            'items' => $items,
            'class' => $class,
            'search' => $search,
            'totalAssets' => count($all),
            'topGainer' => $topGainerItem['symbol'] ?? '—',
            'topGainerChange' => $topGainerItem['changeRaw'] ?? '',
            'topLoser' => $topLoserItem['symbol'] ?? '—',
            'topLoserChange' => $topLoserItem['changeRaw'] ?? '',
            'activeClassCount' => $counts->count(),
            'counts' => $counts,
        ]);
    }

    public function trade()
    {
        return view('dashboard.trade', [
            'active' => 'trade',
            'headerTitle' => 'Trade Center',
            'markets' => $this->marketAssets(),
            'prices' => collect($this->marketAssets())->pluck('price', 'symbol')->map(fn ($p) => (float) $p)->all(),
            'openTrades' => Trade::where('user_id', Auth::id())->whereIn('status', ['open', 'processing'])->latest()->get(),
            'closedTrades' => Trade::where('user_id', Auth::id())->where('status', 'closed')->latest()->get(),
        ]);
    }

    public function storeTrade(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'trading_asset_id' => ['required', 'integer'],
            'trade_type' => ['required', 'in:binary,spot'],
            'action' => ['required', 'in:buy,sell'],
            'amount' => ['required', 'numeric', 'min:1'],
            'leverage' => ['required', 'integer', 'in:2,5,10,25,50,100'],
            'duration' => ['required_if:trade_type,binary', 'nullable', 'integer', 'min:1'],
        ]);

        $isDemo = $request->boolean('is_demo');

        $asset = collect($this->marketAssets())
            ->firstWhere('id', (int) $data['trading_asset_id']);

        if (! $asset) {
            return back()->with('error', 'Selected asset is no longer available. Please pick another asset.');
        }

        $amount = (float) $data['amount'];

        if (! $isDemo) {
            if ((float) $user->balance < $amount) {
                return back()->with('error', 'Insufficient balance for this trade. Please deposit funds first.');
            }
            $user->decrement('balance', $amount);
        }

        $trade = Trade::create([
            'user_id' => $user->id,
            'trading_asset_id' => $asset['id'],
            'symbol' => $asset['symbol'],
            'name' => $asset['name'],
            'asset_class' => $asset['asset_class'],
            'trade_type' => $data['trade_type'],
            'action' => $data['action'],
            'amount' => $amount,
            'leverage' => (int) $data['leverage'],
            'entry_price' => $asset['price'] ?: 0,
            'duration' => $data['trade_type'] === 'binary' ? (int) $data['duration'] : null,
            'expires_at' => $data['trade_type'] === 'binary' ? now()->addMinutes((int) $data['duration']) : null,
            'status' => 'open',
            'result' => 'pending',
            'pnl' => 0,
            'is_demo' => $isDemo,
        ]);

        if (! $isDemo) {
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'debit',
                'title' => 'Trade placed: ' . $asset['symbol'] . ' (' . strtoupper($data['action']) . ')',
                'amount' => $amount,
                'status' => 'completed',
                'reference' => 'TRD-' . strtoupper(Str::random(10)),
                'note' => $data['trade_type'] . ' trade · ' . $data['leverage'] . 'x leverage',
            ]);
        }

        return back()->with('success', 'Trade placed successfully! ' . ($trade->is_demo ? '(DEMO)' : '') . ' Your order is now active.');
    }

    public function processExpiredTrade(Request $request)
    {
        $tradeId = (int) $request->input('trade_id');
        $trade = Trade::where('user_id', Auth::id())
            ->where('id', $tradeId)
            ->where('status', 'open')
            ->where('trade_type', 'binary')
            ->first();

        if (! $trade) {
            return response()->json(['success' => false, 'error' => 'Trade not found.'], 404);
        }

        if ($trade->expires_at && $trade->expires_at->isFuture()) {
            return response()->json(['success' => false, 'error' => 'Trade has not expired yet.'], 422);
        }

        $asset = collect($this->marketAssets())
            ->firstWhere('id', (int) $trade->trading_asset_id);

        $current = $asset ? (float) ($asset['price'] ?: $trade->entry_price) : (float) $trade->entry_price;

        $won = $trade->action === 'buy'
            ? $current >= (float) $trade->entry_price
            : $current <= (float) $trade->entry_price;

        $pnl = round($trade->amount * $trade->leverage / 100, 2);
        $result = $won ? 'win' : 'loss';
        $trade->pnl = $won ? $pnl : -$pnl;
        $trade->result = $result;
        $trade->status = 'closed';
        $trade->closed_at = now();
        $trade->save();

        if (! $trade->is_demo) {
            if ($won && $pnl > 0) {
                Auth::user()->increment('balance', $pnl);
                Auth::user()->increment('total_profit', $pnl);
                Transaction::create([
                    'user_id' => $trade->user_id,
                    'type' => 'credit',
                    'title' => 'Trade win: ' . $trade->symbol,
                    'amount' => $trade->pnl,
                    'status' => 'completed',
                    'reference' => 'TRW-' . strtoupper(Str::random(10)),
                    'note' => 'Binary trade settled',
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Trade settled as ' . $result . '.', 'result' => $result]);
    }

    public function requestCloseSpot(Request $request)
    {
        $tradeId = (int) $request->input('trade_id');
        $trade = Trade::where('user_id', Auth::id())
            ->where('id', $tradeId)
            ->where('status', 'open')
            ->where('trade_type', 'spot')
            ->first();

        if (! $trade) {
            return response()->json(['success' => false, 'error' => 'Trade not found.'], 404);
        }

        $trade->status = 'processing';
        $trade->save();

        return response()->json(['success' => true, 'message' => 'Close request submitted. An admin will review and settle your trade shortly.']);
    }

    public function positions()
    {
        return view('dashboard.positions', [
            'active' => 'positions',
            'headerTitle' => 'Trade Positions',
            'openTrades' => Trade::where('user_id', Auth::id())->whereIn('status', ['open', 'processing'])->latest()->get(),
        ]);
    }

    public function tradingHistory()
    {
        return view('dashboard.tradinghistory', [
            'active' => 'tradinghistory',
            'headerTitle' => 'Trade History',
            'allTrades' => Trade::where('user_id', Auth::id())->latest()->get(),
        ]);
    }

    public function marketAssets(): array
    {
        return array_map(fn ($m) => [
            'id' => $m['id'],
            'name' => $m['name'],
            'symbol' => $m['symbol'],
            'asset_class' => $m['class'],
            'price' => $m['price'] !== '' ? (float) str_replace(',', '', $m['price']) : 0,
            'price_change_pct_24h' => $m['change'] !== '' ? (float) str_replace(['+', '%'], '', $m['change']) : 0,
            'logo_url' => $m['img'],
        ], $this->allMarkets());
    }

    public function index()
    {
        $user = Auth::user();
        $user->load(['transactions', 'deposits', 'withdrawals', 'investments']);

        return view('dashboard.index', [
            'active' => 'dashboard',
            'headerTitle' => 'Account Dashboard',
            'user' => $user,
            'markets' => collect($this->marketAssets())->take(6)->map(fn ($m) => [
                'symbol' => $m['symbol'],
                'price' => $m['price'],
                'change' => $m['price_change_pct_24h'],
            ])->all(),
            'stocks' => $this->stocks(),
            'forex' => $this->forex(),
            'recentTransactions' => $user->transactions()->latest()->take(8)->get(),
            'experts' => $this->experts(),
        ]);
    }

    public function showDeposits()
    {
        $user = Auth::user();

        return view('dashboard.deposits', [
            'active' => 'deposits',
            'headerTitle' => 'Deposits',
            'user' => $user,
            'deposits' => $user->deposits()->latest()->get(),
            'wallets' => config('services.crypto.wallets'),
            'networks' => config('crypto.networks'),
        ]);
    }

    public function showConnectWallet()
    {
        $user = Auth::user();

        return view('dashboard.connect-wallet', [
            'active' => 'connect-wallet',
            'headerTitle' => 'Connect Wallet',
            'user' => $user,
            'wallets' => config('services.crypto.wallets'),
        ]);
    }

    public function storeDeposit(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'method' => ['required', 'string', 'max:50'],
            'network' => ['required', 'string', 'max:50', 'in:' . implode(',', array_keys(config('crypto.networks', [])))],
            'tx_hash' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-z0-9]+$/'],
            'sender_address' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'in:manual,wallet'],
            'proof' => ['nullable', 'image', 'max:5120'],
        ], [
            'network.in' => 'The selected deposit network is not supported.',
            'tx_hash.regex' => 'The transaction hash contains invalid characters.',
        ]);

        $user = Auth::user();

        $network = config('crypto.networks.' . $data['network']);

        if (! $network || ! $network['address']) {
            return back()->with('error', 'Deposits are not currently available on the selected network.');
        }

        $txHash = $data['tx_hash'] ?? null;

        if ($txHash) {
            $exists = Deposit::where('tx_hash', $txHash)->exists();

            if ($exists) {
                return back()->with('error', 'This transaction has already been submitted and is being reviewed.');
            }
        }

        $proofPath = null;

        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
        }

        $source = ($data['source'] ?? 'manual') === 'wallet' ? 'wallet' : 'manual';

        try {
            $deposit = DB::transaction(function () use ($user, $data, $network, $txHash, $source, $proofPath) {
                $deposit = $user->deposits()->create([
                    'amount' => $data['amount'],
                    'method' => $data['method'],
                    'network' => $data['network'],
                    'address' => $network['address'],
                    'tx_hash' => $txHash,
                    'source' => $source,
                    'sender_address' => $data['sender_address'] ?? null,
                    'proof' => $proofPath,
                    'status' => 'pending',
                ]);

                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'deposit',
                    'title' => 'Deposit via ' . $data['method'] . ' (' . $data['network'] . ')',
                    'amount' => $data['amount'],
                    'status' => 'pending',
                    'reference' => 'DEP-' . Str::upper(Str::random(10)),
                ]);

                return $deposit;
            });
        } catch (QueryException $e) {
            if ($this->isUniqueConstraintViolation($e)) {
                return back()->with('error', 'This transaction has already been submitted and is being reviewed.');
            }

            report($e);

            return back()->with('error', 'We could not record your deposit. Please try again.');
        }

        return back()->with('success', 'Deposit request submitted. It will be reviewed shortly.');
    }

    private function isUniqueConstraintViolation(QueryException $e): bool
    {
        return in_array((string) $e->getCode(), ['23000', '23505'], true);
    }

    public function showWithdrawals()
    {
        $user = Auth::user();

        return view('dashboard.withdrawals', [
            'active' => 'withdrawals',
            'headerTitle' => 'Withdrawals',
            'user' => $user,
            'withdrawals' => $user->withdrawals()->latest()->get(),
        ]);
    }

    public function storeWithdrawal(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:100'],
            'method' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        if ($data['amount'] > (float) $user->balance) {
            return back()->withErrors(['amount' => 'Insufficient balance.']);
        }

        $user->withdrawals()->create([
            'amount' => $data['amount'],
            'method' => $data['method'],
            'address' => $data['address'],
            'status' => 'pending',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'title' => 'Withdrawal via ' . $data['method'],
            'amount' => $data['amount'],
            'status' => 'pending',
            'reference' => 'WDR-' . Str::upper(Str::random(10)),
        ]);

        return back()->with('success', 'Withdrawal request submitted.');
    }

    public function accountHistory()
    {
        $user = Auth::user();

        return view('dashboard.accounthistory', [
            'active' => 'accounthistory',
            'headerTitle' => 'Transaction History',
            'user' => $user,
            'transactions' => $user->transactions()->latest()->get(),
        ]);
    }

    public function portfolio()
    {
        $user = Auth::user();

        return view('dashboard.portfolio', [
            'active' => 'portfolio',
            'headerTitle' => 'Portfolio',
            'user' => $user,
            'investments' => $user->investments()->latest()->get(),
        ]);
    }

    public function accountSettings()
    {
        $user = Auth::user()->load(['deposits', 'withdrawals', 'investments']);

        return view('dashboard.account-settings', [
            'active' => 'account-settings',
            'headerTitle' => 'Profile & Settings',
            'user' => $user,
            'deposits' => $user->deposits()->latest()->get(),
            'withdrawals' => $user->withdrawals()->latest()->get(),
            'investments' => $user->investments()->latest()->get(),
        ]);
    }

    public function updateAccountSettings(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'currency_code' => ['nullable', 'string', 'max:10'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $user->update([
            'name' => $data['name'],
            'username' => $data['username'],
            'phone' => $data['phone'] ?? $user->phone,
            'gender' => $data['gender'] ?? $user->gender,
            'country' => $data['country'] ?? $user->country,
            'currency_code' => $data['currency_code'] ?? $user->currency_code,
        ]);

        if (!empty($data['password'])) {
            $user->update(['password' => bcrypt($data['password'])]);
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function storeSupport(Request $request)
    {
        $data = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'priority' => ['nullable', 'string', 'in:low,medium,high'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'reference' => 'SUP-' . strtoupper(Str::random(10)),
            'subject' => $data['subject'],
            'priority' => $data['priority'] ?? 'medium',
            'message' => $data['message'],
            'status' => 'open',
        ]);

        return redirect()->route('dashboard.support')->with('success', 'Your support ticket has been submitted. Our team will get back to you shortly.');
    }

    public function loansApply()
    {
        return view('dashboard.loans-apply', [
            'active' => 'loans/apply',
            'headerTitle' => 'Apply for Loan',
            'user' => Auth::user(),
            'plans' => $this->loanPlans(),
        ]);
    }

    public function myLoans()
    {
        return view('dashboard.my-loans', [
            'active' => 'loans/apply',
            'headerTitle' => 'My Loans',
            'user' => Auth::user(),
            'loans' => Auth::user()->loans()->latest()->get(),
        ]);
    }

    public function loanPreview(Request $request)
    {
        $id = (int) $request->input('loan_plan_id');
        $amount = (float) $request->input('amount');
        $duration = (int) $request->input('duration');

        $plan = collect($this->loanPlans())->firstWhere('id', $id);

        if (!$plan) {
            return response()->json(['error' => 'Invalid loan plan.'], 422);
        }

        if ($amount < $plan['min_amount'] || $amount > $plan['max_amount']) {
            return response()->json(['error' => "Amount must be between \$" . number_format($plan['min_amount'], 2) . " and \$" . number_format($plan['max_amount'], 2) . "."], 422);
        }

        if ($duration < $plan['min_duration'] || $duration > $plan['max_duration']) {
            return response()->json(['error' => "Duration must be between {$plan['min_duration']} and {$plan['max_duration']} months."], 422);
        }

        $rate = $plan['interest_rate'];

        if ($plan['interest_type'] === 'compound') {
            $monthlyRate = $rate / 100 / 12;
            $total = $amount * pow(1 + $monthlyRate, $duration);
            $totalInterest = $total - $amount;
        } else {
            $totalInterest = $amount * ($rate / 100) * ($duration / 12);
            $total = $amount + $totalInterest;
        }

        $processingFeeAmount = $amount * ($plan['processing_fee'] / 100);
        $totalRepayable = $total + $processingFeeAmount;
        $monthlyPayment = $duration > 0 ? $totalRepayable / $duration : 0;

        return response()->json([
            'interest_rate' => $rate,
            'interest_type' => $plan['interest_type'],
            'total_interest' => round($totalInterest, 2),
            'processing_fee' => round($processingFeeAmount, 2),
            'total_repayable' => round($totalRepayable, 2),
            'monthly_payment' => round($monthlyPayment, 2),
        ]);
    }

    public function storeLoan(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'loan_plan_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric', 'min:1'],
            'duration' => ['required', 'integer', 'min:1'],
            'purpose' => ['required', 'string', 'max:2000'],
        ]);

        $plan = collect($this->loanPlans())->firstWhere('id', (int) $data['loan_plan_id']);

        if (!$plan) {
            return back()->withErrors(['loan_plan_id' => 'The selected loan plan is invalid.']);
        }

        if ($data['amount'] < $plan['min_amount'] || $data['amount'] > $plan['max_amount']) {
            return back()->withErrors(['amount' => "The loan amount must be between \$" . number_format($plan['min_amount'], 2) . " and \$" . number_format($plan['max_amount'], 2) . " for the {$plan['name']}."]);
        }

        if ($data['duration'] < $plan['min_duration'] || $data['duration'] > $plan['max_duration']) {
            return back()->withErrors(['duration' => "The loan duration must be between {$plan['min_duration']} and {$plan['max_duration']} months."]);
        }

        $rate = $plan['interest_rate'];
        $amount = (float) $data['amount'];
        $duration = (int) $data['duration'];

        if ($plan['interest_type'] === 'compound') {
            $monthlyRate = $rate / 100 / 12;
            $total = $amount * pow(1 + $monthlyRate, $duration);
            $totalInterest = $total - $amount;
        } else {
            $totalInterest = $amount * ($rate / 100) * ($duration / 12);
            $total = $amount + $totalInterest;
        }

        $processingFeeAmount = $amount * ($plan['processing_fee'] / 100);
        $totalRepayable = $total + $processingFeeAmount;

        $user->loans()->create([
            'reference' => 'LON-' . Str::upper(Str::random(10)),
            'plan_name' => $plan['name'],
            'amount' => $amount,
            'duration' => $duration,
            'interest_rate' => $rate,
            'interest_type' => $plan['interest_type'],
            'processing_fee' => $plan['processing_fee'],
            'total_interest' => round($totalInterest, 2),
            'processing_fee_amount' => round($processingFeeAmount, 2),
            'total_repayable' => round($totalRepayable, 2),
            'monthly_payment' => $duration > 0 ? round($totalRepayable / $duration, 2) : 0,
            'purpose' => $data['purpose'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your loan application has been submitted successfully. Our team will review it shortly.');
    }

    protected function stocks(): array
    {
        return [
            ['symbol' => 'AAPL', 'name' => 'Apple Inc.', 'price' => 260.81, 'change' => -0.01],
            ['symbol' => 'MSFT', 'name' => 'Microsoft Corp.', 'price' => 404.88, 'change' => -0.22],
            ['symbol' => 'GOOGL', 'name' => 'Alphabet Inc.', 'price' => 308.70, 'change' => 0.54],
            ['symbol' => 'TSLA', 'name' => 'Tesla Inc.', 'price' => 248.45, 'change' => 1.88],
            ['symbol' => 'NVDA', 'name' => 'NVIDIA Corp.', 'price' => 138.71, 'change' => 0.94],
            ['symbol' => 'AMZN', 'name' => 'Amazon.com Inc.', 'price' => 198.36, 'change' => -0.65],
        ];
    }

    protected function forex(): array
    {
        return [
            ['symbol' => 'EUR/USD', 'name' => 'Euro / US Dollar', 'price' => 1.15418, 'change' => -0.27],
            ['symbol' => 'GBP/USD', 'name' => 'British Pound / US Dollar', 'price' => 1.33793, 'change' => -0.29],
            ['symbol' => 'USD/JPY', 'name' => 'US Dollar / Japanese Yen', 'price' => 159.109, 'change' => 0.10],
            ['symbol' => 'USD/CHF', 'name' => 'US Dollar / Swiss Franc', 'price' => 0.8921, 'change' => 0.35],
            ['symbol' => 'AUD/USD', 'name' => 'Australian Dollar / US Dollar', 'price' => 0.6564, 'change' => 0.18],
            ['symbol' => 'USD/CAD', 'name' => 'US Dollar / Canadian Dollar', 'price' => 1.3625, 'change' => -0.12],
        ];
    }

    protected function expertProfiles(): array
    {
        return [
            2 => ['name' => 'Albert Burgess', 'type' => 'Mixed', 'followers' => 4000, 'roi' => 12.00, 'duration' => 30, 'win' => 67, 'min' => 500.00, 'max' => 200000, 'last_trade' => '03 September', 'image' => 'experts/GMFwXyAvtIngLHF3WWL0ZVIQv0xPEQYdap7AfcFB.jpg'],
            3 => ['name' => 'Axel Merk', 'type' => 'Mixed', 'followers' => 3000, 'roi' => 20.00, 'duration' => 30, 'win' => 65, 'min' => 2500.00, 'max' => 250000, 'last_trade' => '03 September', 'image' => 'experts/blzX1VIWDtVrGLfViyCnthLITC0SH6qYamkrMCKy.jpg'],
            4 => ['name' => 'Paul Tudor Jones', 'type' => 'Mixed', 'followers' => 40000, 'roi' => 6.34, 'duration' => 30, 'win' => 86, 'min' => 1300.00, 'max' => 150000, 'last_trade' => '03 September', 'image' => 'experts/uAzXukRIVidkzW3TuEj2tnh4VHjLn7rR1wOOwZVL.jpg'],
            5 => ['name' => 'Andrew Kreiger', 'type' => 'Mixed', 'followers' => 5456766, 'roi' => 14.00, 'duration' => 30, 'win' => 95, 'min' => 5400.00, 'max' => 500000, 'last_trade' => '03 September', 'image' => 'experts/Pig6FQxoDQopSzBT2xsrbKrlQnHnk0Qh70ZEWHrN.jpg'],
            6 => ['name' => 'Andrei Neagu', 'type' => 'Mixed', 'followers' => 7000000, 'roi' => 65.00, 'duration' => 30, 'win' => 66, 'min' => 300.00, 'max' => 100000, 'last_trade' => '03 September', 'image' => 'experts/aXps1D2XJxOyBphvaIOIBVVPm7umALLmq4T4ePf6.jpg'],
            7 => ['name' => 'Abdullah Rasheed', 'type' => 'Mixed', 'followers' => 65000, 'roi' => 12.00, 'duration' => 30, 'win' => 78, 'min' => 700.00, 'max' => 180000, 'last_trade' => '03 September', 'image' => 'experts/w7rvBcvM4y7NO9bnWNXk5A6MSlaco0rIJH36qlaA.jpg'],
            8 => ['name' => 'Alex Gonzalez', 'type' => 'Mixed', 'followers' => 400000, 'roi' => 13.00, 'duration' => 30, 'win' => 98, 'min' => 500.00, 'max' => 200000, 'last_trade' => '03 September', 'image' => 'experts/8ArEeTJN5JySoUFHCpW277KhSowQzrqxybZVMjec.jpg'],
        ];
    }

    public function expertPage($id)
    {
        $profiles = $this->expertProfiles();

        if (!isset($profiles[$id])) {
            abort(404);
        }

        $copying = \App\Models\CopyTrade::where('user_id', Auth::id())
            ->where('expert_id', $id)
            ->where('status', 'active')
            ->exists();

        return view('dashboard.expert', [
            'active' => 'copy-trading',
            'headerTitle' => $profiles[$id]['name'],
            'expert' => $profiles[$id],
            'expertId' => (int) $id,
            'copying' => $copying,
        ]);
    }

    public function startCopying(Request $request, $id)
    {
        $profiles = $this->expertProfiles();

        if (!isset($profiles[$id])) {
            abort(404);
        }

        $expert = $profiles[$id];
        $user = Auth::user();

        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        $amount = (float) $data['amount'];

        if ($amount < (float) $expert['min']) {
            return back()->withErrors(['amount' => "The minimum investment for {$expert['name']} is $" . number_format($expert['min'], 2) . '.']);
        }

        if ($amount > (float) $expert['max']) {
            return back()->withErrors(['amount' => "The maximum investment for {$expert['name']} is $" . number_format($expert['max'], 2) . '.']);
        }

        if ($amount > (float) $user->balance) {
            return back()->withErrors(['amount' => 'Insufficient balance to start copying. Please deposit funds first.']);
        }

        $existing = \App\Models\CopyTrade::where('user_id', $user->id)->where('expert_id', $id)->where('status', 'active')->first();

        if ($existing) {
            return back()->with('info', "You are already copying {$expert['name']}. Increase the amount below.");
        }

        $start = now();

        $user->decrement('balance', $amount);

        \App\Models\CopyTrade::create([
            'user_id' => $user->id,
            'expert_id' => $id,
            'expert_name' => $expert['name'],
            'amount' => $amount,
            'roi' => $expert['roi'],
            'duration_days' => $expert['duration'],
            'status' => 'active',
            'started_at' => $start->toDateTimeString(),
            'expires_at' => $start->copy()->addDays((int) $expert['duration'])->toDateTimeString(),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'copy_trade',
            'title' => "Copy trade started: {$expert['name']} ({$expert['duration']} days)",
            'amount' => $amount,
            'status' => 'completed',
            'reference' => 'CPY-' . Str::upper(Str::random(10)),
        ]);

        return back()->with('success', "You are now copying {$expert['name']}. Your investment of $" . number_format($amount, 2) . ' has been activated.');
    }

    protected function botProfiles(): array
    {
        return [
            1 => ['name' => 'ScalpX Pro', 'type' => 'Scalping', 'subscribers' => '401 +', 'roi' => 2.50, 'max_duration' => 30, 'win' => 72, 'min' => 100.00, 'max' => 150000, 'interval' => '5m'],
            2 => ['name' => 'DayTrader Elite', 'type' => 'Day Trading', 'subscribers' => '400 +', 'roi' => 3.20, 'max_duration' => 60, 'win' => 65, 'min' => 250.00, 'max' => 200000, 'interval' => '10m'],
            3 => ['name' => 'SwingMaster', 'type' => 'Swing Trading', 'subscribers' => '400 +', 'roi' => 4.00, 'max_duration' => 90, 'win' => 68, 'min' => 500.00, 'max' => 300000, 'interval' => '15m'],
            4 => ['name' => 'CryptoSniper', 'type' => 'Scalping', 'subscribers' => '400 +', 'roi' => 5.00, 'max_duration' => 30, 'win' => 60, 'min' => 200.00, 'max' => 180000, 'interval' => '5m'],
            5 => ['name' => 'Sentinel AI', 'type' => 'Day Trading', 'subscribers' => '400 +', 'roi' => 3.80, 'max_duration' => 45, 'win' => 70, 'min' => 500.00, 'max' => 250000, 'interval' => '8m'],
            6 => ['name' => 'Apex Swing', 'type' => 'Swing Trading', 'subscribers' => '400 +', 'roi' => 2.00, 'max_duration' => 90, 'win' => 75, 'min' => 1000.00, 'max' => 350000, 'interval' => '20m'],
            7 => ['name' => 'Turbo Scalp', 'type' => 'Scalping', 'subscribers' => '400 +', 'roi' => 1.80, 'max_duration' => 14, 'win' => 78, 'min' => 50.00, 'max' => 50000, 'interval' => '5m'],
            8 => ['name' => 'Horizon Fund', 'type' => 'Day Trading', 'subscribers' => '400 +', 'roi' => 2.80, 'max_duration' => 60, 'win' => 66, 'min' => 300.00, 'max' => 220000, 'interval' => '10m'],
        ];
    }

    public function botPage($id)
    {
        $profiles = $this->botProfiles();

        if (!isset($profiles[$id])) {
            abort(404);
        }

        $active = \App\Models\BotSubscription::where('user_id', Auth::id())
            ->where('bot_id', $id)
            ->where('status', 'active')
            ->exists();

        return view('dashboard.bot', [
            'active' => 'bot-trading',
            'headerTitle' => $profiles[$id]['name'],
            'bot' => $profiles[$id],
            'botId' => (int) $id,
            'subscribed' => $active,
        ]);
    }

    public function startBot(Request $request, $id)
    {
        $profiles = $this->botProfiles();

        if (!isset($profiles[$id])) {
            abort(404);
        }

        $bot = $profiles[$id];
        $user = Auth::user();

        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
        ]);

        $amount = (float) $data['amount'];

        if ($amount < (float) $bot['min']) {
            return back()->withErrors(['amount' => "The minimum investment for {$bot['name']} is $" . number_format($bot['min'], 2) . '.']);
        }

        if ($amount > (float) $bot['max']) {
            return back()->withErrors(['amount' => "The maximum investment for {$bot['name']} is $" . number_format($bot['max'], 2) . '.']);
        }

        if ($amount > (float) $user->balance) {
            return back()->withErrors(['amount' => 'Insufficient balance to run this bot. Please deposit funds first.']);
        }

        $exists = \App\Models\BotSubscription::where('user_id', $user->id)->where('bot_id', $id)->where('status', 'active')->exists();

        if ($exists) {
            return back()->with('info', "The {$bot['name']} bot is already running for your account.");
        }

        $start = now();

        $user->decrement('balance', $amount);

        \App\Models\BotSubscription::create([
            'user_id' => $user->id,
            'bot_id' => $id,
            'bot_name' => $bot['name'],
            'bot_type' => $bot['type'],
            'amount' => $amount,
            'roi' => $bot['roi'],
            'duration_days' => $bot['max_duration'],
            'status' => 'active',
            'started_at' => $start->toDateTimeString(),
            'expires_at' => $start->copy()->addDays((int) $bot['max_duration'])->toDateTimeString(),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'bot_subscription',
            'title' => "Trading bot deployed: {$bot['name']} ({$bot['max_duration']} days)",
            'amount' => $amount,
            'status' => 'completed',
            'reference' => 'BOT-' . Str::upper(Str::random(10)),
        ]);

        return back()->with('success', "The {$bot['name']} bot is now running. Your investment of $" . number_format($amount, 2) . ' has been deployed successfully.');
    }

    protected function preIpoProfiles(): array
    {
        return [
            1 => ['name' => 'SpaceX', 'ticker' => 'SP', 'label' => 'SPACEX', 'featured' => true, 'price' => 185.00, 'change' => '+0%', 'available' => 49999, 'total' => 50000, 'status' => 'Open'],
            2 => ['name' => 'Stripe', 'ticker' => 'ST', 'label' => 'STRIPE', 'featured' => true, 'price' => 72.50, 'change' => '+0%', 'available' => 100000, 'total' => 100000, 'status' => 'Open'],
            3 => ['name' => 'Databricks', 'ticker' => 'DA', 'label' => 'DATABR', 'featured' => false, 'price' => 54.00, 'change' => '+0%', 'available' => 75000, 'total' => 75000, 'status' => 'Upcoming'],
            4 => ['name' => 'Canva', 'ticker' => 'CA', 'label' => 'CANVA', 'featured' => true, 'price' => 38.25, 'change' => '+0%', 'available' => 120000, 'total' => 120000, 'status' => 'Open'],
        ];
    }

    public function preIpoPage($id)
    {
        $profiles = $this->preIpoProfiles();

        if (!isset($profiles[$id])) {
            abort(404);
        }

        $company = $profiles[$id];
        $used = PreIpoHolding::where('user_id', Auth::id())->where('company_id', $id)->sum('shares');
        $myShares = PreIpoHolding::where('user_id', Auth::id())->where('company_id', $id)->sum('shares');

        return view('dashboard.pre-ipo-company', [
            'active' => 'pre-ipo',
            'headerTitle' => $company['name'],
            'company' => $company,
            'companyId' => (int) $id,
            'myShares' => $myShares,
            'myInvestment' => PreIpoHolding::where('user_id', Auth::id())->where('company_id', $id)->sum('amount'),
            'remaining' => $company['total'] - $used,
        ]);
    }

    public function buyPreIpo(Request $request, $id)
    {
        $profiles = $this->preIpoProfiles();

        if (!isset($profiles[$id])) {
            abort(404);
        }

        $company = $profiles[$id];

        if (($company['status'] ?? 'Open') !== 'Open') {
            return back()->with('info', "Investing in {$company['name']} is not available yet — it is marked as Upcoming.");
        }

        $user = Auth::user();

        $data = $request->validate([
            'shares' => ['required', 'integer', 'min:1'],
        ]);

        $shares = (int) $data['shares'];
        $used = PreIpoHolding::where('user_id', $user->id)->where('company_id', $id)->sum('shares');
        $remaining = $company['total'] - $used;

        if ($shares > $remaining) {
            return back()->withErrors(['shares' => "Only {$remaining} shares of {$company['name']} are available to buy."]);
        }

        $price = (float) $company['price'];
        $amount = $shares * $price;

        if ($amount > (float) $user->balance) {
            return back()->withErrors(['shares' => 'Insufficient balance to complete this purchase. Please deposit funds first.']);
        }

        $user->decrement('balance', $amount);

        PreIpoHolding::create([
            'user_id' => $user->id,
            'company_id' => $id,
            'company_name' => $company['name'],
            'ticker' => $company['ticker'],
            'shares' => $shares,
            'price_per_share' => $price,
            'amount' => $amount,
            'status' => 'active',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'pre_ipo_purchase',
            'title' => "Purchased {$shares} {$company['name']} ({$company['ticker']}) pre-IPO shares",
            'amount' => $amount,
            'status' => 'completed',
            'reference' => 'IPO-' . Str::upper(Str::random(10)),
        ]);

        return back()->with('success', "You purchased {$shares} share" . ($shares > 1 ? 's' : '') . " of {$company['name']} at \$" . number_format($price, 2) . ' each.');
    }

    public function preIpoHoldings()
    {
        $holdings = PreIpoHolding::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.pre-ipo-holdings', [
            'active' => 'pre-ipo',
            'headerTitle' => 'My Pre-IPO Holdings',
            'holdings' => $holdings,
            'totalInvested' => $holdings->sum('amount'),
            'totalShares' => $holdings->sum('shares'),
            'profiles' => $this->preIpoProfiles(),
        ]);
    }

    protected function stockProfiles(): array
    {
        return [
            28 => ['symbol' => 'AAPL', 'name' => 'Apple Inc.', 'price' => 260.81, 'change' => '-0.01%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AAPL.png'],
            29 => ['symbol' => 'MSFT', 'name' => 'Microsoft Corp.', 'price' => 404.88, 'change' => '-0.22%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/MSFT.png'],
            30 => ['symbol' => 'GOOGL', 'name' => 'Alphabet Inc.', 'price' => 308.70, 'change' => '+0.54%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/GOOG.png'],
            31 => ['symbol' => 'AMZN', 'name' => 'Amazon.com, Inc.', 'price' => 212.65, 'change' => '-0.78%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AMZN.png'],
            32 => ['symbol' => 'TSLA', 'name' => 'Tesla Inc.', 'price' => 175.34, 'change' => '-2.15%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/TSLA.png'],
            33 => ['symbol' => 'NVDA', 'name' => 'NVIDIA Corporation', 'price' => 878.35, 'change' => '+3.42%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/NVDA.png'],
            34 => ['symbol' => 'META', 'name' => 'Meta Platforms Inc.', 'price' => 502.18, 'change' => '+1.58%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/FB.png'],
            35 => ['symbol' => 'NFLX', 'name' => 'Netflix Inc.', 'price' => 628.73, 'change' => '+0.45%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/NFLX.png'],
            37 => ['symbol' => 'INTC', 'name' => 'Intel Corporation', 'price' => 42.31, 'change' => '-0.56%', 'logo' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/INTC.png'],
            38 => ['symbol' => 'PYPL', 'name' => 'PayPal Holdings', 'price' => 63.28, 'change' => '+0.72%', 'logo' => null],
            39 => ['symbol' => 'DIS', 'name' => 'Walt Disney Co.', 'price' => 112.45, 'change' => '+0.31%', 'logo' => null],
            40 => ['symbol' => 'BA', 'name' => 'Boeing Company', 'price' => 188.92, 'change' => '-0.89%', 'logo' => null],
            41 => ['symbol' => 'JPM', 'name' => 'JPMorgan Chase & Co.', 'price' => 198.37, 'change' => '+0.64%', 'logo' => null],
        ];
    }

    protected function stockPosition($userId, $symbol)
    {
        $bought = StockTrade::where('user_id', $userId)->where('symbol', $symbol)->where('type', 'buy')->sum('shares');
        $sold = StockTrade::where('user_id', $userId)->where('symbol', $symbol)->where('type', 'sell')->sum('shares');

        return (float) $bought - (float) $sold;
    }

    public function stockPage($id)
    {
        $profiles = $this->stockProfiles();

        if (!isset($profiles[$id])) {
            abort(404);
        }

        $stock = $profiles[$id];
        $profile = $this->stockPosition(Auth::id(), $stock['symbol']);
        $avg = StockTrade::where('user_id', Auth::id())->where('symbol', $stock['symbol'])->where('type', 'buy')->avg('price');

        return view('dashboard.stock', [
            'active' => 'stocks',
            'headerTitle' => $stock['symbol'],
            'stock' => $stock,
            'stockId' => (int) $id,
            'held' => round($profile, 6),
            'avgCost' => $avg ? (float) $avg : 0,
            'heldValue' => $profile * (float) $stock['price'],
        ]);
    }

    public function tradeStock(Request $request, $id)
    {
        $profiles = $this->stockProfiles();

        if (!isset($profiles[$id])) {
            abort(404);
        }

        $stock = $profiles[$id];
        $user = Auth::user();

        $data = $request->validate([
            'type' => ['required', 'in:buy,sell'],
            'shares' => ['required', 'numeric', 'min:0.000001'],
        ]);

        $type = $data['type'];
        $shares = (float) $data['shares'];
        $price = (float) $stock['price'];
        $amount = round($shares * $price, 2);

        if ($type === 'buy') {
            if ($amount > (float) $user->balance) {
                return back()->withErrors(['shares' => 'Insufficient balance to place this order. Please deposit funds first.']);
            }

            $user->decrement('balance', $amount);

            StockTrade::create([
                'user_id' => $user->id,
                'stock_id' => $id,
                'symbol' => $stock['symbol'],
                'company_name' => $stock['name'],
                'type' => 'buy',
                'shares' => $shares,
                'price' => $price,
                'amount' => $amount,
                'status' => 'filled',
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'stock_purchase',
                'title' => "Bought " . rtrim(rtrim(number_format($shares, 6, '.', ''), '0'), '.') . " {$stock['symbol']} shares at \$" . number_format($price, 2),
                'amount' => $amount,
                'status' => 'completed',
                'reference' => 'STK-' . Str::upper(Str::random(10)),
            ]);

            return back()->with('success', "Order filled: bought " . rtrim(rtrim(number_format($shares, 6, '.', ''), '0'), '.') . " {$stock['symbol']} share(s) for \$" . number_format($amount, 2) . '.');
        }

        $held = $this->stockPosition($user->id, $stock['symbol']);

        if ($shares > ($held + 0.000001)) {
            return back()->withErrors(['shares' => "You only hold " . rtrim(rtrim(number_format($held, 6, '.', ''), '0'), '.') . " {$stock['symbol']} share(s)."]);
        }

        $user->increment('balance', $amount);

        StockTrade::create([
            'user_id' => $user->id,
            'stock_id' => $id,
            'symbol' => $stock['symbol'],
            'company_name' => $stock['name'],
            'type' => 'sell',
            'shares' => $shares,
            'price' => $price,
            'amount' => $amount,
            'status' => 'filled',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'stock_sale',
            'title' => "Sold " . rtrim(rtrim(number_format($shares, 6, '.', ''), '0'), '.') . " {$stock['symbol']} shares at \$" . number_format($price, 2),
            'amount' => $amount,
            'status' => 'completed',
            'reference' => 'STK-' . Str::upper(Str::random(10)),
        ]);

        return back()->with('success', "Order filled: sold " . rtrim(rtrim(number_format($shares, 6, '.', ''), '0'), '.') . " {$stock['symbol']} share(s) for \$" . number_format($amount, 2) . '.');
    }

    public function stockPortfolio()
    {
        $userId = Auth::id();
        $profiles = $this->stockProfiles();
        $positions = [];
        $totalValue = 0.0;
        $totalCost = 0.0;

        foreach (StockTrade::where('user_id', $userId)->get() as $trade) {
            $key = $trade->symbol;
            if (!isset($positions[$key])) {
                $positions[$key] = ['shares' => 0.0, 'cost' => 0.0];
            }
            if ($trade->type === 'buy') {
                $positions[$key]['shares'] += (float) $trade->shares;
                $positions[$key]['cost'] += (float) $trade->amount;
            } else {
                $positions[$key]['shares'] -= (float) $trade->shares;
                $positions[$key]['cost'] -= (float) $trade->amount;
            }
        }

        $positions = array_filter($positions, fn ($p) => $p['shares'] > 0.000001);

        $rows = [];
        foreach ($positions as $symbol => $pos) {
            $p = collect($profiles)->firstWhere('symbol', $symbol);
            $current = $p ? (float) $p['price'] : 0;
            $value = $pos['shares'] * $current;
            $totalValue += $value;
            $totalCost += $pos['cost'];
            $rows[] = [
                'symbol' => $symbol,
                'company' => $p['name'] ?? $symbol,
                'logo' => $p['logo'] ?? null,
                'shares' => round($pos['shares'], 6),
                'avgCost' => $pos['shares'] > 0 ? round($pos['cost'] / $pos['shares'], 2) : 0,
                'current' => $current,
                'value' => round($value, 2),
                'stockId' => $p && ($id = array_search($p, $profiles, true)) !== false ? (int) $id : null,
            ];
        }

        usort($rows, fn ($a, $b) => $b['value'] <=> $a['value']);

        return view('dashboard.stock-portfolio', [
            'active' => 'stocks',
            'headerTitle' => 'My Stock Portfolio',
            'rows' => $rows,
            'totalValue' => round($totalValue, 2),
            'totalCost' => round($totalCost, 2),
        ]);
    }

    public function stockHistory()
    {
        $trades = StockTrade::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();

        return view('dashboard.stock-history', [
            'active' => 'stocks',
            'headerTitle' => 'Stock Trade History',
            'trades' => $trades,
        ]);
    }

    public function nftGallery(Request $request)
    {
        $query = NftItem::where('status', 'listed');

        if ($category = $request->integer('category_id')) {
            $query->where('category_id', $category);
        }
        if ($collection = $request->integer('collection_id')) {
            $query->where('collection_id', $collection);
        }
        if ($search = trim((string) $request->get('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }
        if ($min = $request->float('min_price')) {
            $query->where('price', '>=', $min);
        }
        if ($max = $request->float('max_price')) {
            $query->where('price', '<=', $max);
        }

        switch ($request->get('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'liked':
                $query->orderBy('likes', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $items = $query->get();
        $collections = NftCollection::withCount('items')->get();

        return view('dashboard.nft-gallery', [
            'active' => 'nft-gallery',
            'headerTitle' => 'NFT Marketplace',
            'items' => $items,
            'collections' => $collections,
            'filters' => $request->only(['category_id', 'collection_id', 'search', 'min_price', 'max_price', 'sort']),
        ]);
    }

    public function nftMint()
    {
        return view('dashboard.nfts-create', [
            'active' => 'nfts/create',
            'headerTitle' => 'Mint NFT',
        ]);
    }

    public function nftStore(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:500'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'category_id' => ['required', 'integer', 'exists:nft_categories,id'],
            'collection_id' => ['nullable', 'integer', 'exists:nft_collections,id'],
            'properties' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,gif,webp', 'max:5120'],
        ]);

        $gas = 5.00;

        if ($gas > (float) $user->balance) {
            return back()->withErrors(['name' => 'Insufficient balance to cover the minting gas fee ($5.00).']);
        }

        $properties = null;
        if (!empty($data['properties'])) {
            $decoded = json_decode($data['properties'], true);
            $properties = is_array($decoded) ? $decoded : null;
        }

        $path = $request->file('image')->store('nfts', 'public');

        $user->decrement('balance', $gas);

        $item = NftItem::create([
            'owner_id' => $user->id,
            'created_by' => $user->id,
            'collection_id' => $data['collection_id'] ?? null,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'image' => $path,
            'price' => $data['price'],
            'properties' => $properties,
            'status' => 'listed',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'nft_mint',
            'title' => "Minted NFT: {$item->name} (gas fee)",
            'amount' => $gas,
            'status' => 'completed',
            'reference' => 'NFT-' . Str::upper(Str::random(10)),
        ]);

        return redirect()->route('dashboard.nft-detail', $item->id)->with('success', 'Your NFT was minted successfully.');
    }

    public function nftCollection(NftCollection $collection)
    {
        $items = NftItem::where('collection_id', $collection->id)
            ->where('status', 'listed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.nft-collection', [
            'active' => 'nfts/collection',
            'headerTitle' => $collection->name,
            'collection' => $collection,
            'items' => $items,
        ]);
    }

    public function nftDetail($id)
    {
        $item = NftItem::with('owner', 'collection', 'category')->findOrFail($id);

        $item->increment('views');

        return view('dashboard.nft-detail', [
            'active' => 'nft-gallery',
            'headerTitle' => $item->name,
            'item' => $item,
        ]);
    }

    public function nftBuy(Request $request, $id)
    {
        $user = Auth::user();
        $item = NftItem::findOrFail($id);

        if ($item->status !== 'listed') {
            return back()->with('info', 'This NFT is no longer available for purchase.');
        }

        if ($item->owner_id === $user->id) {
            return back()->with('info', 'You already own this NFT.');
        }

        $price = (float) $item->price;

        if ($price > (float) $user->balance) {
            return back()->withErrors(['buy' => 'Insufficient balance to purchase this NFT. Please deposit funds first.']);
        }

        $user->decrement('balance', $price);

        $item->forceFill(['owner_id' => $user->id])->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'nft_purchase',
            'title' => "Purchased NFT: {$item->name}",
            'amount' => $price,
            'status' => 'completed',
            'reference' => 'NFT-' . Str::upper(Str::random(10)),
        ]);

        return back()->with('success', "You purchased {$item->name} for \$" . number_format($price, 2) . '.');
    }

    public function myNfts(Request $request)
    {
        $user = Auth::user();
        $tab = $request->get('tab', 'owned');

        $owned = NftItem::where('owner_id', $user->id)->get();
        $created = NftItem::where('created_by', $user->id)->get();
        $createdIds = $created->pluck('id')->all();

        if ($tab === 'created') {
            $items = $created;
            $normalized = 'created';
        } elseif ($tab === 'favorites') {
            $items = collect();
            $normalized = 'favorites';
        } else {
            $items = $owned;
            $normalized = 'owned';
        }

        return view('dashboard.my-nfts', [
            'active' => 'my-nfts',
            'headerTitle' => 'My NFTs',
            'tab' => $normalized,
            'items' => $items,
            'ownedCount' => $owned->count(),
            'createdCount' => $created->count(),
            'favoritesCount' => 0,
            'totalValue' => $owned->sum('price'),
            'ownedIds' => $owned->pluck('id')->all(),
            'createdIds' => $createdIds,
        ]);
    }

    protected function experts(): array
    {
        return [
            ['name' => 'Axel Merk', 'type' => 'Mixed', 'win' => 65, 'roi' => 20.00, 'avatar' => asset('storage/experts/blzX1VIWDtVrGLfViyCnthLITC0SH6qYamkrMCKy.jpg')],
            ['name' => 'Andrew Kreiger', 'type' => 'Mixed', 'win' => 95, 'roi' => 14.00, 'avatar' => asset('storage/experts/Pig6FQxoDQopSzBT2xsrbKrlQnHnk0Qh70ZEWHrN.jpg')],
            ['name' => 'Andrei Neagu', 'type' => 'Mixed', 'win' => 66, 'roi' => 65.00, 'avatar' => asset('storage/experts/aXps1D2XJxOyBphvaIOIBVVPm7umALLmq4T4ePf6.jpg')],
        ];
    }

    public function buyPlan()
    {
        return view('dashboard.buy-plan', [
            'active' => 'buy-plan',
            'headerTitle' => 'Investment Plans',
            'user' => Auth::user(),
            'plans' => $this->investmentPlans(),
        ]);
    }

    public function notifications()
    {
        $user = Auth::user();

        return view('dashboard.notification', [
            'active' => 'notification',
            'headerTitle' => 'Notifications',
            'notifications' => $user->notifications()->latest()->paginate(20),
        ]);
    }

    public function unreadNotifications()
    {
        $user = Auth::user();

        $notifs = $user->notifications()
            ->where('is_read', false)
            ->latest()
            ->take(10)
            ->get(['id', 'title', 'message', 'created_at']);

        return response()->json([
            'notifications' => $notifs->map(function ($n) {
                return [
                    'id' => $n->id,
                    'title' => $n->title,
                    'message' => $n->message,
                    'time' => $n->created_at->diffForHumans(),
                ];
            }),
            'count' => $user->notifications()->where('is_read', false)->count(),
        ]);
    }

    public function readAllNotifications()
    {
        Auth::user()->notifications()->where('is_read', false)->update(['is_read' => true]);

        return response()->json(['ok' => true]);
    }

    public function storePlan(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'plan_name' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $plan = InvestmentPlan::where('name', $data['plan_name'])->where('is_active', true)->first();

        if (!$plan) {
            return redirect()->route('dashboard.buy-plan')->withErrors(['plan_name' => 'The selected investment plan is invalid.'])->withInput();
        }

        if ($data['amount'] < (float) $plan->min_amount || ($plan->max_amount !== null && $data['amount'] > (float) $plan->max_amount)) {
            $range = $plan->max_amount !== null ? '$' . number_format((float) $plan->min_amount, 2) . ' - $' . number_format((float) $plan->max_amount, 2) : '$' . number_format((float) $plan->min_amount, 2) . '+';
            return redirect()->route('dashboard.buy-plan')->withErrors(['amount' => "The investment amount must be within $range for the {$plan->name}."])->withInput();
        }

        if ($data['amount'] > $user->balance) {
            return redirect()->route('dashboard.buy-plan')->withErrors(['amount' => 'Insufficient balance for this investment. Please deposit funds first.'])->withInput();
        }

        $start = now();
        $end = $start->copy()->addDays((int) $plan->duration);

        $user->investments()->create([
            'investment_plan_id' => $plan->id,
            'plan_name' => $plan->name,
            'amount' => $data['amount'],
            'interest_rate' => (float) $plan->interest_rate,
            'duration_days' => (int) $plan->duration,
            'start_date' => $start->toDateString(),
            'end_date' => $end->toDateString(),
            'status' => 'active',
        ]);

        $user->decrement('balance', $data['amount']);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'investment',
            'title' => 'Investment in ' . $plan->name,
            'amount' => $data['amount'],
            'status' => 'completed',
            'reference' => 'INV-' . Str::upper(Str::random(10)),
        ]);

        return redirect()->route('dashboard.buy-plan')->with('success', 'Your investment in the ' . $plan->name . ' has been activated successfully.')->with('last_plan', $plan->name);
    }

    public function myPlans(string $status = 'All')
    {
        $all = Auth::user()->investments()->latest()->get()->map(function ($inv) {
            $isCompleted = $inv->status === 'completed' || ($inv->status === 'active' && $inv->end_date->lt(now()->toDateString()));
            $inv->display_status = $isCompleted ? 'completed' : 'active';
            $inv->expected_return = round((float) $inv->amount * ((float) $inv->interest_rate / 100), 2);
            return $inv;
        })->values();

        $active = $all->filter(fn ($i) => $i->display_status === 'active')->values();
        $completed = $all->filter(fn ($i) => $i->display_status === 'completed')->values();

        $filtered = match (strtolower($status)) {
            'active' => $active,
            'completed' => $completed,
            default => $all,
        };

        return view('dashboard.myplans', [
            'active' => 'myplans',
            'headerTitle' => 'My Plans',
            'user' => Auth::user(),
            'plans' => $this->investmentPlans(),
            'status' => $status,
            'all' => $all,
            'activePlans' => $active,
            'completedPlans' => $completed,
            'filtered' => $filtered,
        ]);
    }

    public function courseDetails(string $slug, $courseId)
    {
        $course = Course::where('slug', $slug)->where('id', $courseId)->where('is_active', true)->firstOrFail();

        return view('dashboard.course-details', [
            'active' => 'courses',
            'headerTitle' => $course->title,
            'course' => $course,
            'lessons' => $course->lessons()->get(),
            'enrolled' => CourseEnrollment::where('user_id', Auth::id())->where('course_id', $course->id)->exists(),
        ]);
    }

    public function enrollCourse(Request $request, $courseId)
    {
        $course = Course::where('id', $courseId)->where('is_active', true)->firstOrFail();
        $user = Auth::user();

        if (CourseEnrollment::where('user_id', $user->id)->where('course_id', $course->id)->exists()) {
            return redirect()->route('dashboard.course-details', ['slug' => $course->slug, 'courseId' => $course->id])
                ->with('info', 'You already have access to this course.');
        }

        if ($course->price > 0 && $course->price > (float) $user->balance) {
            return back()->withErrors(['enroll' => 'Insufficient balance to enroll in this course. Please deposit funds first.']);
        }

        if ($course->price > 0) {
            $user->decrement('balance', $course->price);

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'course_purchase',
                'title' => 'Course purchase: ' . $course->title,
                'amount' => $course->price,
                'status' => 'completed',
                'reference' => 'CRS-' . Str::upper(Str::random(10)),
            ]);
        }

        CourseEnrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount_paid' => $course->price > 0 ? $course->price : 0,
            'status' => 'active',
        ]);

        return redirect()->route('dashboard.course-details', ['slug' => $course->slug, 'courseId' => $course->id])
            ->with('success', 'Enrollment successful. Start learning now.');
    }

    public function learning($lessonId)
    {
        $lesson = CourseLesson::findOrFail($lessonId);

        if ($lesson->course_id !== null) {
            $course = Course::where('id', $lesson->course_id)->where('is_active', true)->first();
            $enrolled = $course
                && CourseEnrollment::where('user_id', Auth::id())->where('course_id', $course->id)->exists();

            if (!$enrolled && $course && $course->price > 0) {
                return redirect()->route('dashboard.course-details', ['slug' => $course->slug, 'courseId' => $course->id])
                    ->withErrors(['enroll' => 'Enroll in this course to access its lessons.']);
            }

            $siblings = $course ? $course->lessons()->get() : collect();
            $prev = null;
            $next = null;
            foreach ($siblings as $i => $sib) {
                if ($sib->id == $lesson->id) {
                    $prev = $siblings->get($i - 1);
                    $next = $siblings->get($i + 1);
                    break;
                }
            }

            return view('dashboard.learning', [
                'active' => 'my-courses',
                'headerTitle' => $lesson->title,
                'lesson' => $lesson,
                'course' => $course,
                'siblings' => $siblings,
                'prev' => $prev,
                'next' => $next,
            ]);
        }

        return view('dashboard.learning', [
            'active' => 'courses',
            'headerTitle' => $lesson->title,
            'lesson' => $lesson,
            'course' => null,
            'siblings' => collect(),
            'prev' => null,
            'next' => null,
        ]);
    }

    public function myCourses()
    {
        $user = Auth::user();
        $enrollments = CourseEnrollment::where('user_id', $user->id)
            ->with(['course'])
            ->orderByDesc('created_at')
            ->get()
            ->filter(fn ($e) => $e->course && $e->course->is_active);

        return view('dashboard.my-courses', [
            'active' => 'my-courses',
            'headerTitle' => 'My Courses',
            'enrollments' => $enrollments,
        ]);
    }

    public function storeSubscribe(Request $request)
    {
        $data = $request->validate([
            'plan_id' => ['required', 'integer'],
        ]);

        $plan = SignalPlan::where('id', $data['plan_id'])->where('is_active', true)->first();
        $user = Auth::user();

        if (!$plan) {
            return back()->withErrors(['plan_id' => 'The selected signal plan is invalid.']);
        }

        if ($plan->price > (float) $user->balance) {
            return back()->withErrors(['plan_id' => 'Insufficient balance to subscribe to this plan. Please deposit funds first.']);
        }

        $start = now();
        $end = $start->copy()->addWeeks((int) $plan->duration);

        $user->decrement('balance', $plan->price);

        $user->signalSubscriptions()->create([
            'signal_plan_id' => $plan->id,
            'plan_name' => $plan->name,
            'price' => $plan->price,
            'duration' => $plan->duration,
            'status' => 'active',
            'started_at' => $start->toDateTimeString(),
            'ends_at' => $end->toDateTimeString(),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'signal_subscription',
            'title' => 'Signal subscription: ' . $plan->name,
            'amount' => $plan->price,
            'status' => 'completed',
            'reference' => 'SGL-' . Str::upper(Str::random(10)),
        ]);

        return back()->with('success', 'You are now subscribed to the ' . $plan->name . ' plan.');
    }

    public function mySubscriptions()
    {
        return view('dashboard.my-subscriptions', [
            'active' => 'my-subscriptions',
            'headerTitle' => 'My Subscriptions',
            'subscriptions' => Auth::user()->signalSubscriptions()->latest()->get(),
        ]);
    }
}