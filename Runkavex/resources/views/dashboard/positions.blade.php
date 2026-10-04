@php
    $active = 'positions'; $headerTitle = 'Trade Positions';
    $openTrades ??= collect();
    $openTotal = $openTrades->count();
    $openBinary = $openTrades->where('trade_type', 'binary')->count();
    $openSpot = $openTrades->where('trade_type', 'spot')->count();
    $capitalAtRisk = $openTrades->where('is_demo', false)->sum('amount');
@endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Trade Positions')

@section('content')

<div class="p-4 lg:p-6 space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Open Positions</h2>
            <p class="text-sm text-content-secondary mt-1">Manage your currently active trades</p>
        </div>
    </div>

    <div x-data="{ tab: 'all', mode: 'live' }" class="space-y-6">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-3 sm:p-4 hover:border-surface-border-light transition-colors flex items-center gap-3">
                <div class="p-2 rounded-lg bg-primary-subtle shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"></path>
</svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Total Open</p>
                    <p class="text-lg font-bold text-content-primary">{{ $openTotal }}</p>
                </div>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-3 sm:p-4 hover:border-surface-border-light transition-colors flex items-center gap-3">
                <div class="p-2 rounded-lg bg-info/10 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-info" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h4.5M3.75 12h4.5m-4.5 5.25h4.5M8.25 4.5h.75m-0.75 4.5h.75m-0.75 4.5h.75m-.75 4.5h.75M12.75 5.25h7.5M12.75 12h7.5m-7.5 5.25h7.5"></path>
</svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Binary Open</p>
                    <p class="text-lg font-bold text-content-primary">{{ $openBinary }}</p>
                </div>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-3 sm:p-4 hover:border-surface-border-light transition-colors flex items-center gap-3">
                <div class="p-2 rounded-lg bg-gain/10 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75"></path>
</svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Spot Open</p>
                    <p class="text-lg font-bold text-content-primary">{{ $openSpot }}</p>
                </div>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-3 sm:p-4 hover:border-surface-border-light transition-colors flex items-center gap-3">
                <div class="p-2 rounded-lg bg-warning/10 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-warning" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Capital at Risk</p>
                    <p class="text-lg font-bold text-content-primary">${{ number_format($capitalAtRisk, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">

            <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 border-b border-surface-border">
                <div class="flex items-center gap-1 bg-surface-overlay rounded-lg p-1">
                    <button @click="tab = 'all'" :class="tab === 'all' ? 'bg-surface-border text-content-primary' : 'text-content-tertiary hover:text-content-primary'" class="px-3 py-1.5 text-xs font-semibold rounded-md transition-colors">
                        All Positions <span class="opacity-60">({{ $openTotal }})</span>
                    </button>
                    <button @click="tab = 'binary'" :class="tab === 'binary' ? 'bg-surface-border text-content-primary' : 'text-content-tertiary hover:text-content-primary'" class="px-3 py-1.5 text-xs font-semibold rounded-md transition-colors">
                        Binary <span class="opacity-60">({{ $openBinary }})</span>
                    </button>
                    <button @click="tab = 'spot'" :class="tab === 'spot' ? 'bg-surface-border text-content-primary' : 'text-content-tertiary hover:text-content-primary'" class="px-3 py-1.5 text-xs font-semibold rounded-md transition-colors">
                        Spot <span class="opacity-60">({{ $openSpot }})</span>
                    </button>
                </div>

                <div class="flex items-center gap-1 bg-surface-overlay rounded-lg p-1">
                    <button @click="mode = 'all'" :class="mode === 'all' ? 'bg-surface-border text-content-primary' : 'text-content-tertiary hover:text-content-primary'" class="px-3 py-1.5 text-xs font-semibold rounded-md transition-colors">
                        All
                    </button>
                    <button @click="mode = 'live'" :class="mode === 'live' ? 'bg-surface-border text-content-primary' : 'text-content-tertiary hover:text-content-primary'" class="px-3 py-1.5 text-xs font-semibold rounded-md transition-colors">
                        Live
                    </button>
                    <button @click="mode = 'demo'" :class="mode === 'demo' ? 'bg-surface-border text-content-primary' : 'text-content-tertiary hover:text-content-primary'" class="px-3 py-1.5 text-xs font-semibold rounded-md transition-colors">
                        Demo
                    </button>
                </div>
            </div>

            <div role="status" class="{{ $openTrades->isEmpty() ? 'flex flex-col items-center justify-center py-14 px-6 text-center' : 'hidden' }}">
                <div class="p-4 rounded-full bg-surface-overlay mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-content-tertiary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
                </div>
                <h3 class="text-base font-semibold text-content-primary mb-1">No open positions</h3>
                <p class="text-sm text-content-tertiary max-w-sm mb-4">You don't have any active trades right now. Open a position to get started.</p>
                <a href="{{ url('/dashboard/trade') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-surface-base">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
                    Start Trading
                </a>
            </div>

            @if(! $openTrades->isEmpty())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-surface-border">
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Asset</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Action</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Leverage</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Entry</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Expires</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Mode</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-border">
                        @foreach($openTrades as $trade)
                            <tr>
                                <td class="px-4 py-3 text-content-tertiary">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $trade->trade_type === 'binary' ? 'bg-surface-overlay text-content-secondary' : 'bg-primary/10 text-primary' }}">{{ $trade->trade_type }}</span>
                                </td>
                                <td class="px-4 py-3 text-content-primary">
                                    <span class="font-medium">{{ $trade->symbol }}</span>
                                    <span class="block text-xs text-content-tertiary">{{ $trade->name }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 text-xs font-medium rounded {{ $trade->action === 'buy' ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ strtoupper($trade->action) }}</span>
                                </td>
                                <td class="px-4 py-3 text-content-primary">{{ number_format($trade->amount, 2) }}</td>
                                <td class="px-4 py-3 text-content-secondary">{{ $trade->leverage }}x</td>
                                <td class="px-4 py-3 text-content-primary">{{ $trade->entry_price }}</td>
                                <td class="px-4 py-3 text-content-secondary">{{ $trade->expires_at?->format('M j, H:i') ?? 'No expiry' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 text-xs font-medium rounded {{ $trade->is_demo ? 'bg-surface-overlay text-content-tertiary' : 'bg-gain/10 text-gain' }}">{{ $trade->is_demo ? 'Demo' : 'Live' }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-xs text-content-tertiary">{{ $trade->status === 'processing' ? 'Close requested' : ($trade->is_demo ? 'DEMO' : 'Active') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection