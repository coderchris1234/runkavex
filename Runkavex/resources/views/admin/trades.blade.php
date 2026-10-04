@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Trades</h2>
            <p class="text-sm text-content-secondary mt-1">All trades across the platform — settle spot positions and override results</p>
        </div>
        <a href="{{ route('admin.trades.create') }}" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">+ Create Trade</a>
    </div>

    <form method="GET" action="{{ route('admin.trades') }}" class="flex flex-wrap gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search symbol (e.g. BTC)"
            class="w-56 bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
        <select name="status" onchange="this.form.submit()" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="all" {{ $statusFilter === 'all' ? 'selected' : '' }}>All statuses</option>
            <option value="open" {{ $statusFilter === 'open' ? 'selected' : '' }}>Open</option>
            <option value="processing" {{ $statusFilter === 'processing' ? 'selected' : '' }}>Processing (close requested)</option>
            <option value="closed" {{ $statusFilter === 'closed' ? 'selected' : '' }}>Closed</option>
        </select>
        <button type="submit" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Filter</button>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">#</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Asset</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Type</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Action</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Lev</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Entry</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Mode</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Settle</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($trades as $trade)
                        <tr>
                            <td class="px-5 py-3 text-content-tertiary">
                                <a href="{{ route('admin.trades.show', $trade) }}" class="text-primary hover:text-primary-light font-medium">{{ $trade->id }}</a>
                            </td>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $trade->user) }}" class="font-medium text-content-primary hover:text-primary">{{ $trade->user->name }}</a>
                                <p class="text-xs text-content-tertiary">{{ $trade->created_at->format('M j, H:i') }}</p>
                            </td>
                            <td class="px-5 py-3">
                                <p class="font-medium text-content-primary">{{ $trade->symbol }}</p>
                                <p class="text-xs text-content-tertiary">{{ $trade->name }}</p>
                            </td>
                            <td class="px-5 py-3 capitalize text-content-secondary">{{ $trade->trade_type }}</td>
                            <td class="px-5 py-3 uppercase font-medium {{ $trade->action === 'buy' ? 'text-gain' : 'text-loss' }}">{{ $trade->action }}</td>
                            <td class="px-5 py-3 text-content-primary">${{ number_format($trade->amount, 2) }}</td>
                            <td class="px-5 py-3 text-content-secondary">{{ $trade->leverage }}x</td>
                            <td class="px-5 py-3 text-content-secondary">{{ $trade->entry_price }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded {{ $trade->is_demo ? 'bg-surface-overlay text-content-tertiary' : 'bg-primary/10 text-primary' }}">{{ $trade->is_demo ? 'Demo' : 'Live' }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $trade->status === 'closed' ? 'bg-surface-overlay text-content-tertiary' : ($trade->status === 'open' ? 'bg-gain/10 text-gain' : 'bg-warning/10 text-warning') }}">{{ $trade->status }}</span>
                                @if($trade->result !== 'pending')
                                    <p class="text-xs mt-0.5 uppercase {{ $trade->result === 'win' ? 'text-gain' : 'text-loss' }}">{{ $trade->result }} · ${{ number_format($trade->pnl, 2) }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @if($trade->status !== 'closed')
                                    <form method="POST" action="{{ url('/admin/trades/' . $trade->id . '/settle') }}" class="flex gap-1.5">
                                        @csrf
                                        <input type="hidden" name="result" value="win">
                                        <button type="submit" class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-gain/10 text-gain hover:bg-gain/20 transition-colors">Win</button>
                                    </form>
                                    <form method="POST" action="{{ url('/admin/trades/' . $trade->id . '/settle') }}" class="flex gap-1.5 mt-1" @submit="confirm('Mark as loss?')" x-data>
                                        @csrf
                                        <input type="hidden" name="result" value="loss">
                                        <button type="submit" class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Loss</button>
                                    </form>
                                @else
                                    <span class="text-xs text-content-tertiary">Settled {{ $trade->closed_at?->format('M j') }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="11" class="px-5 py-8 text-center text-content-tertiary">No trades found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $trades->links() }}</div>
    </div>
</div>

@endsection