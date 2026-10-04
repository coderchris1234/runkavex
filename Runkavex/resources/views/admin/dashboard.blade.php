@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <div>
        <h2 class="text-xl font-bold text-content-primary">Dashboard</h2>
        <p class="text-sm text-content-secondary mt-1">Platform overview and pending reviews</p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Total Users</p>
            <p class="text-2xl font-bold text-content-primary mt-1">{{ number_format($totalUsers) }}</p>
            <p class="text-xs text-content-tertiary mt-1">${{ number_format($totalBalance, 2) }} combined balance</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Deposits</p>
            <p class="text-2xl font-bold text-content-primary mt-1">${{ number_format($totalDeposits, 2) }}</p>
            <p class="text-xs {{ $pendingDeposits > 0 ? 'text-warning' : 'text-content-tertiary' }} mt-1">{{ $pendingDeposits }} pending review</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Withdrawals</p>
            <p class="text-2xl font-bold text-content-primary mt-1">${{ number_format($totalWithdrawals, 2) }}</p>
            <p class="text-xs {{ $pendingWithdrawals > 0 ? 'text-warning' : 'text-content-tertiary' }} mt-1">{{ $pendingWithdrawals }} pending review</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Active Investments</p>
            <p class="text-2xl font-bold text-content-primary mt-1">{{ $activeInvestments }}</p>
            <p class="text-xs {{ $pendingLoans > 0 ? 'text-warning' : 'text-content-tertiary' }} mt-1">{{ $pendingLoans }} pending loans</p>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.deposits') }}" class="bg-surface-raised border border-surface-border rounded-xl p-4 hover:border-primary/50 transition-colors">
            <p class="text-sm font-semibold text-content-primary">Pending Deposits</p>
            <p class="text-2xl font-bold mt-1 {{ $pendingDeposits ? 'text-warning' : 'text-content-tertiary' }}">{{ $pendingDeposits }}</p>
        </a>
        <a href="{{ route('admin.withdrawals') }}" class="bg-surface-raised border border-surface-border rounded-xl p-4 hover:border-primary/50 transition-colors">
            <p class="text-sm font-semibold text-content-primary">Pending Withdrawals</p>
            <p class="text-2xl font-bold mt-1 {{ $pendingWithdrawals ? 'text-warning' : 'text-content-tertiary' }}">{{ $pendingWithdrawals }}</p>
        </a>
        <a href="{{ route('admin.loans') }}" class="bg-surface-raised border border-surface-border rounded-xl p-4 hover:border-primary/50 transition-colors">
            <p class="text-sm font-semibold text-content-primary">Pending Loans</p>
            <p class="text-2xl font-bold mt-1 {{ $pendingLoans ? 'text-warning' : 'text-content-tertiary' }}">{{ $pendingLoans }}</p>
        </a>
        <a href="{{ route('admin.signals') }}" class="bg-surface-raised border border-surface-border rounded-xl p-4 hover:border-primary/50 transition-colors">
            <p class="text-sm font-semibold text-content-primary">Signal Requests</p>
            <p class="text-2xl font-bold mt-1 {{ $pendingSubscriptions ? 'text-warning' : 'text-content-tertiary' }}">{{ $pendingSubscriptions }}</p>
        </a>
    </div>

    <div class="grid lg:grid-cols-2 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border flex items-center justify-between">
                <h3 class="text-sm font-semibold text-content-primary">Recent Users</h3>
                <a href="{{ route('admin.users') }}" class="text-xs text-primary hover:text-primary-light">View all</a>
            </div>
            <div class="divide-y divide-surface-border">
                @forelse($recentUsers as $user)
                    <a href="{{ route('admin.users.show', $user) }}" class="flex items-center justify-between px-5 py-3 hover:bg-surface-overlay transition-colors">
                        <div>
                            <p class="text-sm font-medium text-content-primary">{{ $user->name }}</p>
                            <p class="text-xs text-content-tertiary">{{ $user->email }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-content-primary">${{ number_format($user->balance, 2) }}</p>
                            <p class="text-xs {{ $user->is_active ? 'text-gain' : 'text-loss' }}">{{ $user->is_active ? 'Active' : 'Deactivated' }}</p>
                        </div>
                    </a>
                @empty
                    <p class="px-5 py-8 text-center text-sm text-content-tertiary">No users yet.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border flex items-center justify-between">
                <h3 class="text-sm font-semibold text-content-primary">Open Support Tickets</h3>
                <a href="{{ route('admin.support') }}" class="text-xs text-primary hover:text-primary-light">View all</a>
            </div>
            <div class="divide-y divide-surface-border">
                @forelse($recentTickets as $ticket)
                    <a href="{{ route('admin.support.show', $ticket) }}" class="flex items-center justify-between px-5 py-3 hover:bg-surface-overlay transition-colors">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-content-primary truncate">{{ $ticket->subject }}</p>
                            <p class="text-xs text-content-tertiary">{{ $ticket->user->name }} · {{ $ticket->reference }}</p>
                        </div>
                        <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $ticket->status === 'open' ? 'bg-warning/10 text-warning' : 'bg-surface-overlay text-content-tertiary' }}">{{ $ticket->status }}</span>
                    </a>
                @empty
                    <p class="px-5 py-8 text-center text-sm text-content-tertiary">No tickets.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="px-5 py-3 border-b border-surface-border flex items-center justify-between">
            <h3 class="text-sm font-semibold text-content-primary">Recent Trades</h3>
            <a href="{{ route('admin.trades') }}" class="text-xs text-primary hover:text-primary-light">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Asset</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Type</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Action</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Result</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($recentTrades as $trade)
                        <tr>
                            <td class="px-5 py-3 text-content-primary">{{ $trade->user->name }}</td>
                            <td class="px-5 py-3 text-content-primary font-medium">{{ $trade->symbol }}</td>
                            <td class="px-5 py-3 capitalize text-content-secondary">{{ $trade->trade_type }}</td>
                            <td class="px-5 py-3 uppercase font-medium {{ $trade->action === 'buy' ? 'text-gain' : 'text-loss' }}">{{ $trade->action }}</td>
                            <td class="px-5 py-3 text-content-primary">${{ number_format($trade->amount, 2) }}</td>
                            <td class="px-5 py-3 capitalize text-content-secondary">{{ $trade->status }}</td>
                            <td class="px-5 py-3 uppercase {{ $trade->result === 'win' ? 'text-gain' : ($trade->result === 'loss' ? 'text-loss' : 'text-content-tertiary') }}">{{ $trade->result }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-8 text-center text-content-tertiary">No trades yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection