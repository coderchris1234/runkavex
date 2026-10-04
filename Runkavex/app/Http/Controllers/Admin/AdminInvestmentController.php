<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminInvestmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Investment::with('user');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        return view('admin.investments', [
            'pageTitle' => 'Investments | Admin Panel',
            'statusFilter' => $request->status ?? 'all',
            'investments' => $query->latest()->paginate(30)->withQueryString(),
        ]);
    }

    public function approve(Investment $investment)
    {
        if ($investment->status !== 'pending') {
            return back()->with('error', 'This investment is not pending.');
        }

        $investment->update(['status' => 'active']);

        $user = $investment->user;
        $user->decrement('balance', (float) $investment->amount);

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'investment',
            'title' => 'Investment activated: ' . $investment->plan_name,
            'amount' => $investment->amount,
            'status' => 'completed',
            'reference' => 'INV-ACTIVE-' . strtoupper(Str::random(10)),
        ]);

        return back()->with('success', 'Investment in "' . $investment->plan_name . '" activated.');
    }

    public function reject(Investment $investment)
    {
        if ($investment->status !== 'pending') {
            return back()->with('error', 'This investment is not pending.');
        }

        $investment->update(['status' => 'rejected']);

        return back()->with('success', 'Investment request rejected.');
    }
}