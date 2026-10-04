<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminWithdrawalController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $query = Withdrawal::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return view('admin.withdrawals', [
            'pageTitle' => 'Withdrawals | Admin Panel',
            'statusFilter' => $request->status,
            'withdrawals' => $query->latest()->paginate(30)->withQueryString(),
            'users' => \App\Models\User::orderBy('name')->get(['id', 'name', 'email']),
        ]);
    }

    public function approve(Request $request, Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'This withdrawal has already been processed.');
        }

        $user = $withdrawal->user;

        if ((float) $user->balance < (float) $withdrawal->amount) {
            return back()->with('error', 'Insufficient user balance to honor this withdrawal.');
        }

        $user->decrement('balance', (float) $withdrawal->amount);
        $user->increment('total_withdrawal', (float) $withdrawal->amount);

        $withdrawal->update([
            'status' => 'approved',
            'note' => $request->input('note') ?? $withdrawal->note,
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'title' => 'Withdrawal approved: ' . $withdrawal->method,
            'amount' => -$withdrawal->amount,
            'status' => 'completed',
            'reference' => 'WDR-APPROVED-' . strtoupper(Str::random(10)),
            'note' => $request->input('note'),
        ]);

        $this->logActivity('withdrawal.approve', 'Withdrawal', $withdrawal->id,
            'Approved withdrawal of $' . number_format($withdrawal->amount, 2) . ' for ' . $user->name,
            ['user_id' => $user->id, 'amount' => $withdrawal->amount]);

        return back()->with('success', 'Withdrawal of $' . number_format($withdrawal->amount, 2) . ' approved.');
    }

    public function reject(Request $request, Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'This withdrawal has already been processed.');
        }

        $withdrawal->update([
            'status' => 'rejected',
            'note' => $request->input('note'),
        ]);

        $this->logActivity('withdrawal.reject', 'Withdrawal', $withdrawal->id,
            'Rejected withdrawal of $' . number_format($withdrawal->amount, 2) . ' for ' . $withdrawal->user->name);

        return back()->with('success', 'Withdrawal request rejected. No funds were deducted.');
    }
}