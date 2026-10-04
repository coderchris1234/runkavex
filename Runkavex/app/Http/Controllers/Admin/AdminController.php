<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Loan;
use App\Models\SignalSubscription;
use App\Models\SupportTicket;
use App\Models\Trade;
use App\Models\User;
use App\Models\Withdrawal;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingDeposits = Deposit::where('status', 'pending')->count();
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->count();
        $pendingLoans = Loan::where('status', 'pending')->count();
        $openTickets = SupportTicket::where('status', 'open')->count();
        $pendingSubscriptions = SignalSubscription::where('status', 'pending')->count();

        $totalUsers = User::count();
        $totalBalance = (float) User::sum('balance');
        $totalDeposits = (float) Deposit::where('status', 'approved')->sum('amount');
        $totalWithdrawals = (float) Withdrawal::where('status', 'approved')->sum('amount');

        $recentUsers = User::latest()->take(6)->get();
        $recentTrades = Trade::with('user')->latest()->take(6)->get();
        $recentDeposits = Deposit::with('user')->latest()->take(6)->get();
        $recentTickets = SupportTicket::with('user')->latest()->take(6)->get();

        return view('admin.dashboard', [
            'pageTitle' => 'Dashboard | Admin Panel',
            'pendingDeposits' => $pendingDeposits,
            'pendingWithdrawals' => $pendingWithdrawals,
            'pendingLoans' => $pendingLoans,
            'openTickets' => $openTickets,
            'pendingSubscriptions' => $pendingSubscriptions,
            'totalUsers' => $totalUsers,
            'totalBalance' => $totalBalance,
            'totalDeposits' => $totalDeposits,
            'totalWithdrawals' => $totalWithdrawals,
            'activeInvestments' => Investment::where('status', 'active')->count(),
            'recentUsers' => $recentUsers,
            'recentTrades' => $recentTrades,
            'recentDeposits' => $recentDeposits,
            'recentTickets' => $recentTickets,
        ]);
    }
}