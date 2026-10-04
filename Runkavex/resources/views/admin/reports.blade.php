@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Reports</h2>
            <p class="text-sm text-content-secondary mt-1">Platform performance and trading analytics</p>
        </div>
        <form method="GET" action="{{ route('admin.reports') }}">
            <select name="period" onchange="this.form.submit()" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                <option value="weekly" {{ $period === 'weekly' ? 'selected' : '' }}>Last 10 weeks</option>
                <option value="daily" {{ $period === 'daily' ? 'selected' : '' }}>Last 14 days</option>
                <option value="yearly" {{ $period === 'yearly' ? 'selected' : '' }}>Last 12 months</option>
            </select>
        </form>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Total Deposits</p>
            <p class="text-xl font-bold text-gain mt-1">${{ number_format($totals['deposits'], 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Total Withdrawals</p>
            <p class="text-xl font-bold text-loss mt-1">${{ number_format($totals['withdrawals'], 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Net Flow</p>
            <p class="text-xl font-bold {{ $totals['netFlow'] >= 0 ? 'text-gain' : 'text-loss' }} mt-1">{{ $totals['netFlow'] >= 0 ? '+' : '' }}${{ number_format($totals['netFlow'], 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Win Rate</p>
            <p class="text-xl font-bold text-primary mt-1">{{ $totals['winRate'] }}%</p>
            <p class="text-xs text-content-tertiary mt-1">{{ $totals['wins'] }}W / {{ $totals['losses'] }}L</p>
        </div>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
        <h3 class="text-sm font-semibold text-content-primary mb-4">Daily Flows (deposits vs withdrawals)</h3>
        <div class="flex items-end gap-1 h-48 overflow-x-auto pb-1">
            @foreach($chart as $point)
                <div class="flex flex-col items-center gap-1 min-w-[24px] flex-1">
                    <div class="flex items-end gap-0.5 w-full justify-center">
                        <div class="w-2 rounded-t bg-gain" style="height: {{ max(2, min(120, $point['deposits'] / max(1, $chart->max('deposits')) * 120)) }}px" title="Deposits ${{ number_format($point['deposits'], 0) }}"></div>
                        <div class="w-2 rounded-t bg-loss" style="height: {{ max(2, min(120, $point['withdrawals'] / max(1, $chart->max('withdrawals')) * 120)) }}px" title="Withdrawals ${{ number_format($point['withdrawals'], 0) }}"></div>
                    </div>
                    <span class="text-[9px] text-content-tertiary">{{ \Illuminate\Support\Str::after($point['date'], '-') }}</span>
                </div>
            @endforeach
        </div>
        <div class="flex gap-4 mt-3 text-xs text-content-secondary">
            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded bg-gain inline-block"></span> Deposits</span>
            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded bg-loss inline-block"></span> Withdrawals</span>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border">
                <h3 class="text-sm font-semibold text-content-primary">Top Users by Balance</h3>
            </div>
            <div class="divide-y divide-surface-border">
                @forelse($topUsers as $user)
                    <a href="{{ route('admin.users.show', $user) }}" class="flex items-center justify-between px-5 py-3 hover:bg-surface-overlay transition-colors">
                        <div>
                            <p class="text-sm font-medium text-content-primary">{{ $user->name }}</p>
                            <p class="text-xs text-content-tertiary">{{ $user->trades_count }} trades · {{ $user->deposits_count }} deposits</p>
                        </div>
                        <p class="text-sm font-semibold text-content-primary">${{ number_format($user->balance, 2) }}</p>
                    </a>
                @empty
                    <p class="px-5 py-8 text-center text-sm text-content-tertiary">No users yet.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border flex items-center justify-between">
                <h3 class="text-sm font-semibold text-content-primary">Data Exports</h3>
            </div>
            <div class="p-5 space-y-3">
                <p class="text-sm text-content-secondary">Download CSV backups of your platform data.</p>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.exports.users') }}" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Export Users CSV</a>
                    <a href="{{ route('admin.exports.transactions') }}" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Export Transactions CSV</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection