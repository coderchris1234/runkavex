<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminManualEntryController extends Controller
{
    use LogsAdminActivity;

    public function storeDeposit(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'method' => ['nullable', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::findOrFail($data['user_id']);

        $deposit = Deposit::create([
            'user_id' => $user->id,
            'amount' => $data['amount'],
            'method' => $data['method'] ?? 'Manual',
            'status' => 'approved',
            'note' => $data['note'] ?? null,
            'tx_hash' => 'MANUAL-' . strtoupper(Str::random(12)),
        ]);

        $user->increment('balance', (float) $data['amount']);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'credit',
            'title' => 'Manual deposit added',
            'amount' => $data['amount'],
            'status' => 'completed',
            'reference' => 'DEP-MANUAL-' . strtoupper(Str::random(10)),
            'note' => $data['note'] ?? null,
        ]);

        $this->logActivity('deposit.manual_create', 'Deposit', $deposit->id,
            'Added manual approved deposit of $' . $data['amount'] . ' to ' . $user->name,
            ['user_id' => $user->id, 'amount' => $data['amount']]);

        return back()->with('success', 'Manual deposit of $' . number_format($data['amount'], 2) . ' credited to ' . $user->name . '.');
    }

    public function storeWithdrawal(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'method' => ['nullable', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::findOrFail($data['user_id']);

        if ((float) $user->balance < (float) $data['amount']) {
            return back()->with('error', 'Insufficient user balance to process this manual withdrawal.');
        }

        $deposit = $user->withdrawals()->create([
            'amount' => $data['amount'],
            'method' => $data['method'] ?? 'Manual',
            'status' => 'approved',
            'address' => 'MANUAL',
            'note' => $data['note'] ?? null,
        ]);

        $user->decrement('balance', (float) $data['amount']);
        $user->increment('total_withdrawal', (float) $data['amount']);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'title' => 'Manual withdrawal processed',
            'amount' => -$data['amount'],
            'status' => 'completed',
            'reference' => 'WDR-MANUAL-' . strtoupper(Str::random(10)),
            'note' => $data['note'] ?? null,
        ]);

        $this->logActivity('withdrawal.manual_create', 'Withdrawal', $deposit->id,
            'Processed manual withdrawal of $' . $data['amount'] . ' for ' . $user->name,
            ['user_id' => $user->id, 'amount' => $data['amount']]);

        return back()->with('success', 'Manual withdrawal of $' . number_format($data['amount'], 2) . ' processed for ' . $user->name . '.');
    }
}
