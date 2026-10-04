@extends('layouts.admin')

@section('content')

<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <a href="{{ route('admin.trades') }}" class="text-xs text-content-tertiary hover:text-content-primary mb-1 inline-block">&larr; Back to trades</a>
            <h2 class="text-xl font-bold text-content-primary">Trade #{{ $trade->id }} <span class="text-sm font-medium text-content-tertiary">{{ $trade->symbol }}</span></h2>
        </div>
        <span class="px-3 py-1 text-xs font-medium rounded capitalize {{ $trade->status === 'closed' ? 'bg-surface-overlay text-content-tertiary' : ($trade->status === 'open' ? 'bg-gain/10 text-gain' : 'bg-warning/10 text-warning') }}">{{ $trade->status }}</span>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">User</p>
            <a href="{{ route('admin.users.show', $trade->user) }}" class="text-sm font-semibold text-content-primary mt-1 block hover:text-primary">{{ $trade->user->name }}</a>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Trade Type</p>
            <p class="text-sm font-semibold text-content-primary mt-1 capitalize">{{ $trade->trade_type }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Action</p>
            <p class="text-sm font-semibold {{ $trade->action === 'buy' ? 'text-gain' : 'text-loss' }} mt-1 uppercase">{{ $trade->action }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Mode</p>
            <p class="text-sm font-semibold text-content-primary mt-1 capitalize">{{ $trade->is_demo ? 'Demo' : 'Live' }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Amount</p>
            <p class="text-lg font-bold text-content-primary mt-1">${{ number_format($trade->amount, 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Leverage</p>
            <p class="text-lg font-bold text-content-primary mt-1">{{ $trade->leverage }}x</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Entry Price</p>
            <p class="text-lg font-bold text-content-primary mt-1">{{ $trade->entry_price }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Result</p>
            <p class="text-lg font-bold {{ $trade->result === 'win' ? 'text-gain' : ($trade->result === 'loss' ? 'text-loss' : 'text-content-tertiary') }} mt-1 uppercase">{{ $trade->result }}</p>
        </div>
    </div>

    @if($trade->status !== 'closed')
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5 flex flex-wrap items-center gap-3">
            <p class="text-sm text-content-secondary">Settle this trade:</p>
            <form method="POST" action="{{ url('/admin/trades/' . $trade->id . '/settle') }}">
                @csrf
                <input type="hidden" name="result" value="win">
                <button type="submit" class="px-4 py-2 rounded-lg bg-gain/10 text-gain hover:bg-gain/20 text-sm font-medium transition-colors">Mark as Win</button>
            </form>
            <form method="POST" action="{{ url('/admin/trades/' . $trade->id . '/settle') }}" @submit="confirm('Mark as loss?')" x-data>
                @csrf
                <input type="hidden" name="result" value="loss">
                <button type="submit" class="px-4 py-2 rounded-lg bg-loss/10 text-loss hover:bg-loss/20 text-sm font-medium transition-colors">Mark as Loss</button>
            </form>
        </div>
    @else
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">P/L</p>
                <p class="text-lg font-bold {{ $trade->pnl >= 0 ? 'text-gain' : 'text-loss' }} mt-1">{{ $trade->pnl >= 0 ? '+' : '' }}${{ number_format($trade->pnl, 2) }}</p>
            </div>
            <div>
                <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Closed At</p>
                <p class="text-sm font-semibold text-content-primary mt-1">{{ $trade->closed_at?->format('M j, Y H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Expiry</p>
                <p class="text-sm font-semibold text-content-primary mt-1">{{ $trade->expires_at?->format('M j, Y H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Placed At</p>
                <p class="text-sm font-semibold text-content-primary mt-1">{{ $trade->created_at->format('M j, Y H:i') }}</p>
            </div>
        </div>
    @endif
</div>

@endsection