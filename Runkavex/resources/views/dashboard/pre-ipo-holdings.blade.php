@extends('layouts.dashboard')

@section('pageTitle', 'My Pre-IPO Holdings')

@section('content')

<div class="p-4 lg:p-6 space-y-6">

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ url('') }}/dashboard/pre-ipo" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            Pre-IPO Shares
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">My Holdings</h2>
        <p class="text-sm text-content-secondary mt-1">Pre-IPO shares you own</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Total Invested</p>
            <p class="text-2xl font-bold text-content-primary">${{ number_format($totalInvested, 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Total Shares</p>
            <p class="text-2xl font-bold text-content-primary">{{ number_format($totalShares) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Companies</p>
            <p class="text-2xl font-bold text-content-primary">{{ $holdings->count() }}</p>
        </div>
    </div>

    @if($holdings->count() > 0)
    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-surface-border bg-surface-overlay/50">
                        <th class="text-left text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Company</th>
                        <th class="text-left text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Purchase Date</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Shares</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Price / Share</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Total</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($holdings as $holding)
                    <tr class="border-b border-surface-border last:border-0 hover:bg-surface-overlay/40 transition-colors">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="text-primary text-xs font-bold">{{ $profiles[$holding->company_id]['ticker'] ?? $holding->ticker }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-content-primary">{{ $holding->company_name }}</p>
                                    <p class="text-xs text-content-tertiary font-mono">{{ $profiles[$holding->company_id]['label'] ?? $holding->ticker }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-content-secondary">{{ $holding->created_at->format('M d, Y') }}</td>
                        <td class="px-5 py-4 text-right text-sm font-semibold text-content-primary">{{ number_format($holding->shares) }}</td>
                        <td class="px-5 py-4 text-right text-sm text-content-secondary">${{ number_format($holding->price_per_share, 2) }}</td>
                        <td class="px-5 py-4 text-right text-sm font-semibold text-content-primary">${{ number_format($holding->amount, 2) }}</td>
                        <td class="px-5 py-4 text-right">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gain/10 text-gain">Held</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="bg-surface-raised border border-surface-border rounded-xl p-8 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-content-tertiary mx-auto mb-3" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"></path>
</svg>
        <p class="text-content-secondary mb-2">You haven't purchased any Pre-IPO shares yet.</p>
        <a href="{{ url('') }}/dashboard/pre-ipo" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors">Browse Pre-IPO Shares →</a>
    </div>
    @endif

</div>

@endsection