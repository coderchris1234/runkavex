<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminExportController extends Controller
{
    use LogsAdminActivity;

    public function exportUsers(Request $request)
    {
        $users = User::withCount(['deposits', 'withdrawals'])->orderBy('created_at')->get();

        $filename = 'users_' . date('Y-m-d_His') . '.csv';

        $this->logActivity('export', 'User', null, 'Exported all users to CSV');

        return response($this->usersCsv($users), 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function exportTransactions(Request $request)
    {
        $transactions = Transaction::with('user')->orderByDesc('created_at')->get();

        $filename = 'transactions_' . date('Y-m-d_His') . '.csv';

        $this->logActivity('export', 'Transaction', null, 'Exported all transactions to CSV');

        return response($this->transactionsCsv($transactions), 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    protected function usersCsv($users): string
    {
        $out = fopen('php://temp', 'r+');
        fputcsv($out, [
            'ID', 'Name', 'Username', 'Email', 'Phone', 'Country', 'Balance',
            'Total Profit', 'Bonus', 'Referral Bonus', 'Total Withdrawal',
            'Admin', 'Active', 'Deposits', 'Withdrawals', 'Referral Code', 'Joined',
        ]);

        foreach ($users as $u) {
            fputcsv($out, [
                $u->id,
                $u->name,
                $u->username,
                $u->email,
                $u->phone ?? '',
                $u->country ?? '',
                $u->balance,
                $u->total_profit,
                $u->bonus,
                $u->referral_bonus,
                $u->total_withdrawal,
                $u->is_admin ? 'Yes' : 'No',
                $u->is_active ? 'Yes' : 'No',
                $u->deposits_count,
                $u->withdrawals_count,
                $u->referral_code ?? '',
                $u->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($out);
        $csv = stream_get_contents($out);
        fclose($out);

        return $csv;
    }

    protected function transactionsCsv($transactions): string
    {
        $out = fopen('php://temp', 'r+');
        fputcsv($out, [
            'ID', 'User', 'Email', 'Type', 'Title', 'Amount', 'Status', 'Reference', 'Date',
        ]);

        foreach ($transactions as $t) {
            fputcsv($out, [
                $t->id,
                $t->user?->name ?? 'N/A',
                $t->user?->email ?? '',
                $t->type,
                $t->title,
                $t->amount,
                $t->status,
                $t->reference ?? '',
                $t->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        rewind($out);
        $csv = stream_get_contents($out);
        fclose($out);

        return $csv;
    }
}
