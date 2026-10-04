<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Trade;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->period ?? 'weekly';
        $days = $period === 'daily' ? 14 : ($period === 'yearly' ? 365 : 70);

        $start = now()->subDays($days)->startOfDay();

        $deposits = Deposit::where('status', 'approved')
            ->where('created_at', '>=', $start)
            ->get()
            ->groupBy(fn ($d) => $d->created_at->format('Y-m-d'))
            ->map(fn ($g) => (float) $g->sum('amount'));

        $withdrawals = Withdrawal::where('status', 'approved')
            ->where('created_at', '>=', $start)
            ->get()
            ->groupBy(fn ($w) => $w->created_at->format('Y-m-d'))
            ->map(fn ($g) => (float) $g->sum('amount'));

        $tradePnl = Trade::where('status', 'closed')
            ->where('closed_at', '>=', $start)
            ->get()
            ->groupBy(fn ($t) => $t->closed_at->format('Y-m-d'))
            ->map(fn ($g) => (float) $g->sum('pnl'));

        $allDates = collect();
        for ($i = 0; $i <= $days; $i++) {
            $allDates->put(now()->subDays($days - $i)->format('Y-m-d'), 0);
        }

        $chart = $allDates->map(function ($zero, $date) use ($deposits, $withdrawals, $tradePnl) {
            return [
                'date' => $date,
                'deposits' => $deposits[$date] ?? 0,
                'withdrawals' => $withdrawals[$date] ?? 0,
                'pnl' => $tradePnl[$date] ?? 0,
            ];
        })->values();

        $totals = [
            'deposits' => (float) Deposit::where('status', 'approved')->sum('amount'),
            'withdrawals' => (float) Withdrawal::where('status', 'approved')->sum('amount'),
            'netFlow' => (float) Deposit::where('status', 'approved')->sum('amount')
                - (float) Withdrawal::where('status', 'approved')->sum('amount'),
            'wins' => Trade::where('status', 'closed')->where('result', 'win')->count(),
            'losses' => Trade::where('status', 'closed')->where('result', 'loss')->count(),
            'winRate' => (function () {
                $total = Trade::where('status', 'closed')->count();

                return $total > 0
                    ? round(Trade::where('status', 'closed')->where('result', 'win')->count() / $total * 100, 1)
                    : 0;
            })(),
            'volume' => (float) Trade::where('status', 'open')->sum('amount'),
        ];

        $topUsers = User::withCount(['deposits', 'withdrawals', 'trades'])
            ->orderByDesc('balance')
            ->take(10)
            ->get();

        return view('admin.reports', [
            'pageTitle' => 'Reports | Admin Panel',
            'period' => $period,
            'chart' => $chart,
            'totals' => $totals,
            'topUsers' => $topUsers,
        ]);
    }
}