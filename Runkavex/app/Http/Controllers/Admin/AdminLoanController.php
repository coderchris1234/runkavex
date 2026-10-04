<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminLoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with('user');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        return view('admin.loans', [
            'pageTitle' => 'Loans | Admin Panel',
            'statusFilter' => $request->status ?? 'all',
            'loans' => $query->latest()->paginate(30)->withQueryString(),
        ]);
    }

    public function approve(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'This loan is not pending.');
        }

        $loan->update([
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonths($loan->duration),
        ]);

        $user = $loan->user;
        $user->increment('balance', (float) $loan->amount);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'credit',
            'title' => 'Loan disbursed: ' . $loan->plan_name,
            'amount' => $loan->amount,
            'status' => 'completed',
            'reference' => 'LON-APPROVED-' . strtoupper(Str::random(10)),
        ]);

        return back()->with('success', 'Loan "' . $loan->plan_name . '" approved and disbursed to the user balance.');
    }

    public function reject(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'This loan is not pending.');
        }

        $loan->update(['status' => 'rejected']);

        return back()->with('success', 'Loan application rejected.');
    }

    public function markRepaid(Loan $loan)
    {
        if ($loan->status !== 'active') {
            return back()->with('error', 'Only active loans can be marked repaid.');
        }

        $loan->update([
            'status' => 'repaid',
            'end_date' => now(),
        ]);

        return back()->with('success', 'Loan "' . $loan->plan_name . '" marked as repaid.');
    }
}