@php
    $active = 'pre-ipo';
    $headerTitle = $company['name'];
    $open = ($company['status'] ?? 'Open') === 'Open';
@endphp

@extends('layouts.dashboard')

@section('pageTitle', $company['name'] . ' — Pre-IPO')

@section('content')

<div class="p-4 lg:p-6 space-y-6">

    @if(session('success'))
    <div class="mb-4 rounded-lg border border-gain/30 bg-gain/10 px-4 py-3 text-sm text-gain">
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if(session('info'))
    <div class="mb-4 rounded-lg border border-info/30 bg-info/10 px-4 py-3 text-sm text-info">
        <span>{{ session('info') }}</span>
    </div>
    @endif
    @if($errors->any())
    <div class="mb-4 rounded-lg border border-loss/30 bg-loss/10 px-4 py-3 text-sm text-loss">
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ url('') }}/dashboard/pre-ipo" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            Pre-IPO Shares
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5 sm:p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 rounded-lg bg-primary/10 flex items-center justify-center ring-2 ring-surface-border flex-shrink-0">
                        <span class="text-primary text-xl font-bold">{{ $company['ticker'] }}</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-content-primary">{{ $company['name'] }}</h1>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-content-tertiary text-xs font-mono">{{ $company['label'] }}</span>
                            @if($company['featured'])
                            <span class="text-warning text-xs">★ Featured</span>
                            @endif
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $open ? 'bg-gain/10 text-gain' : 'bg-info/10 text-info' }}">
                                {{ $company['status'] }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Share Price</p>
                        <p class="text-xl font-bold text-content-primary">${{ number_format($company['price'], 2) }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Price Change</p>
                        <p class="text-xl font-bold text-gain">{{ $company['change'] }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Available</p>
                        <p class="text-xl font-bold text-content-primary">{{ number_format($remaining) }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Your Shares</p>
                        <p class="text-xl font-bold text-content-primary">{{ number_format($myShares) }}</p>
                    </div>
                </div>

                <div class="mb-2 flex items-center justify-between">
                    <span class="text-xs text-content-tertiary">Shares Remaining</span>
                    <span class="text-sm font-semibold text-content-primary">{{ number_format($remaining) }} / {{ number_format($company['total']) }}</span>
                </div>
                <div class="w-full h-2 rounded-full bg-surface-overlay overflow-hidden">
                    <div class="h-full rounded-full bg-primary" style="width: {{ $company['total'] > 0 ? (($company['total'] - $remaining) / $company['total']) * 100 : 0 }}%"></div>
                </div>
            </div>

            @if(auth()->user()->balance > 0)
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"></path>
</svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-content-primary">You hold {{ number_format($myShares) }} share{{ $myShares == 1 ? '' : 's' }} of {{ $company['name'] }}</p>
                        <p class="text-xs text-content-tertiary mt-0.5">Invested ${{ number_format($myInvestment, 2) }} — view all in My Holdings.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            @if($open)
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-base font-bold text-content-primary mb-1">Buy {{ $company['label'] }}</h3>
                <p class="text-xs text-content-tertiary mb-5">{{ number_format($remaining) }} shares available at ${{ number_format($company['price'], 2) }} each.</p>

                <form method="POST" action="{{ url('') }}/dashboard/pre-ipo/{{ $companyId }}/buy" x-data="{ shares: '1' }">
                    @csrf
                    <div class="mb-4">
                        <label for="shares" class="block text-sm font-medium text-content-secondary mb-1.5">Number of Shares</label>
                        <input type="number" id="shares" name="shares" min="1" max="{{ $remaining }}" step="1" required
                            x-model="shares"
                            placeholder="1"
                            class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <p class="text-xs text-content-tertiary mt-1.5">Max {{ number_format($remaining) }} shares available</p>
                    </div>

                    <div class="rounded-lg bg-surface-overlay/60 border border-surface-border p-4 mb-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-content-tertiary uppercase tracking-wider">Total Cost</span>
                            <span class="text-lg font-bold text-content-primary" x-text="'$' + (Number(shares || 0) * {{ $company['price'] }}).toFixed(2)">$0.00</span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-content-tertiary uppercase tracking-wider">Price per Share</span>
                            <span class="text-sm font-semibold text-content-primary">${{ number_format($company['price'], 2) }}</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold py-2.5 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"></path>
</svg>
                        Buy Shares
                    </button>
                </form>

                <div class="border-t border-dashed border-surface-border my-5"></div>
                <a href="{{ url('') }}/dashboard/pre-ipo/holdings" class="w-full inline-flex items-center justify-center gap-1.5 bg-surface-overlay hover:bg-surface-border text-content-primary text-sm font-medium py-2.5 rounded-lg border border-surface-border transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"></path>
</svg>
                     My Holdings
                </a>
            </div>
            @else
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6 text-center">
                <div class="w-12 h-12 rounded-full bg-info/10 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-info">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                </div>
                <h3 class="text-base font-bold text-content-primary mb-1">Investing Coming Soon</h3>
                <p class="text-sm text-content-tertiary">Shares in {{ $company['name'] }} are not open for purchase yet. Check back after the offering launches.</p>
            </div>
            @endif
        </div>
    </div>

</div>

@endsection