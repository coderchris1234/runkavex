<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $query = Transaction::with('user');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                    ->orWhere('reference', 'like', "%{$q}%");
            })->orWhereHas('user', function ($u) use ($q) {
                $u->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($request->filled('user_id') && $request->user_id !== '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        $totals = (clone $query)->get();

        return view('admin.transactions', [
            'pageTitle' => 'Transactions | Admin Panel',
            'transactions' => $query->latest()->paginate(30)->withQueryString(),
            'users' => User::orderBy('name')->get(['id', 'name', 'email']),
            'types' => Transaction::distinct()->pluck('type')->sort()->values(),
            'selectedUser' => $request->user_id ?? '',
            'selectedType' => $request->type ?? '',
            'creditTotal' => $totals->where('amount', '>', 0)->sum('amount'),
            'debitTotal' => $totals->where('amount', '<', 0)->sum('amount'),
        ]);
    }

    public function export(Request $request)
    {
        $query = Transaction::with('user');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                    ->orWhere('reference', 'like', "%{$q}%");
            })->orWhereHas('user', function ($u) use ($q) {
                $u->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($request->filled('user_id') && $request->user_id !== '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        $transactions = $query->latest()->get();

        $filename = 'transactions_' . date('Y-m-d_His') . '.csv';

        return response($this->transactionsCsv($transactions), 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
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
