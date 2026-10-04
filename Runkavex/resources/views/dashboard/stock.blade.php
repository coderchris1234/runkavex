@php
    $active = 'stocks';
    $headerTitle = $stock['symbol'];
    $up = str_starts_with($stock['change'], '+');
    $sharesDisplay = $held == 0 ? '0' : rtrim(rtrim(number_format($held, 6, '.', ''), '0'), '.');
@endphp

@extends('layouts.dashboard')

@section('pageTitle', $stock['symbol'] . ' — ' . $stock['name'])

@section('content')

<div class="p-4 lg:p-6 space-y-6">

    @if(session('success'))
    <div class="mb-4 rounded-lg border border-gain/30 bg-gain/10 px-4 py-3 text-sm text-gain">
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if($errors->any())
    <div class="mb-4 rounded-lg border border-loss/30 bg-loss/10 px-4 py-3 text-sm text-loss">
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ url('') }}/dashboard/stocks" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            Stock Shares
        </a>
        <a href="{{ url('') }}/dashboard/stocks/portfolio" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
            My Portfolio
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5 sm:p-6">
                <div class="flex items-center gap-4 mb-6">
                    @if($stock['logo'])
                    <img src="{{ $stock['logo'] }}" alt="{{ $stock['symbol'] }}" class="w-16 h-16 rounded-full object-cover bg-surface-overlay flex-shrink-0">
                    @else
                    <div class="w-16 h-16 rounded-full object-cover bg-surface-overlay bg-primary/15 text-primary flex items-center justify-center font-semibold text-lg flex-shrink-0">{{ $stock['symbol'] }}</div>
                    @endif
                    <div>
                        <h1 class="text-xl font-semibold text-content-primary">{{ $stock['symbol'] }}</h1>
                        <p class="text-xs text-content-tertiary mt-0.5">{{ $stock['name'] }}</p>
                    </div>
                    <div class="ml-auto text-right flex-shrink-0">
                        <p class="text-2xl font-bold text-content-primary">${{ number_format($stock['price'], 2) }}</p>
                        <p class="text-xs font-medium {{ $up ? 'text-gain' : 'text-loss' }}">{{ $stock['change'] }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Shares Held</p>
                        <p class="text-xl font-bold text-content-primary">{{ $sharesDisplay }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Avg Buy Price</p>
                        <p class="text-xl font-bold text-content-primary">{{ $avgCost > 0 ? '$' . number_format($avgCost, 2) : '—' }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Position Value</p>
                        <p class="text-xl font-bold text-content-primary">{{ $held > 0 ? '$' . number_format($heldValue, 2) : '—' }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Today</p>
                        <p class="text-xl font-bold {{ $up ? 'text-gain' : 'text-loss' }}">{{ $stock['change'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-base font-bold text-content-primary mb-4">Trade {{ $stock['symbol'] }}</h3>

                <form method="POST" action="{{ url('') }}/dashboard/stocks/{{ $stockId }}/trade" x-data="{ type: 'buy', shares: '0.01' }">
                    @csrf
                    <input type="hidden" name="type" :value="type">

                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <button type="button" @click="type = 'buy'"
                            :class="type === 'buy' ? 'bg-gain text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary'"
                            class="py-2.5 rounded-lg text-sm font-semibold transition-colors">Buy</button>
                        <button type="button" @click="type = 'sell'"
                            :class="type === 'sell' ? 'bg-loss text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary'"
                            class="py-2.5 rounded-lg text-sm font-semibold transition-colors">Sell</button>
                    </div>

                    <div class="mb-4">
                        <label for="shares" class="block text-sm font-medium text-content-secondary mb-1.5">Shares (fractional allowed)</label>
                        <input type="number" id="shares" name="shares" min="0.000001" step="any" required
                            x-model="shares"
                            placeholder="0.01"
                            class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <p class="text-xs text-content-tertiary mt-1.5">Market order at ${{ number_format($stock['price'], 2) }} / share</p>
                    </div>

                    <div class="rounded-lg bg-surface-overlay/60 border border-surface-border p-4 mb-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-content-tertiary uppercase tracking-wider" x-text="type === 'buy' ? 'Total Cost' : 'Total Proceeds'">Total Cost</span>
                            <span class="text-lg font-bold text-content-primary" x-text="'$' + (Number(shares || 0) * {{ $stock['price'] }}).toFixed(2)">$0.00</span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-content-tertiary uppercase tracking-wider">Market Price</span>
                            <span class="text-sm font-semibold text-content-primary">${{ number_format($stock['price'], 2) }}</span>
                        </div>
                    </div>

                    <button type="submit"
                        :class="type === 'buy' ? 'bg-gain hover:bg-gain-dark' : 'bg-loss hover:bg-loss-dark'"
                        class="w-full inline-flex items-center justify-center gap-2 text-content-inverse text-sm font-semibold py-2.5 rounded-lg transition-colors">
                        <span x-text="type === 'buy' ? 'Place Buy Order' : 'Place Sell Order'">Place Buy Order</span>
                    </button>
                </form>

                <div class="border-t border-dashed border-surface-border my-5"></div>

                <a href="{{ url('') }}/dashboard/stocks/history" class="w-full inline-flex items-center justify-center gap-1.5 bg-surface-overlay hover:bg-surface-border text-content-primary text-sm font-medium py-2.5 rounded-lg border border-surface-border transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                    Trade History
                </a>
            </div>
        </div>
    </div>

</div>

@endsection