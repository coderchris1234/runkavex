@php $active = 'markets'; $headerTitle = 'Markets'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Markets')

@section('content')

        <div class="p-4 lg:p-6 space-y-6">
            
    <div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ url('') }}/dashboard" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
</svg>
 Account
    </a>
    <a href="{{ url('') }}/dashboard/deposits" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
</svg>
 Deposit
    </a>
        <a href="{{ url('') }}/dashboard/withdrawals" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"></path>
</svg>
 Withdraw
    </a>
            <a href="{{ url('') }}/dashboard/trade" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3 12 6.75m0 0L15.75 3M12 6.75V2.25m3.75 9.75h7.5M21 9.375 12 3l-9 6.375M21 21v-7.5M12 6.75v13.5M3.75 12.75h4.5a1.5 1.5 0 0 1 1.5 1.5v4.5a1.5 1.5 0 0 1-1.5 1.5h-4.5a1.5 1.5 0 0 1-1.5-1.5v-4.5a1.5 1.5 0 0 1 1.5-1.5Z"></path>
</svg>
 Trade
    </a>
    <a href="{{ url('') }}/dashboard/portfolio" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"></path>
</svg>
 Portfolio
    </a>
    <a href="{{ url('') }}/dashboard/trades/positions" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"></path>
</svg>
 Positions
    </a>
    <a href="{{ url('') }}/dashboard/markets" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"></path>
</svg>
 Markets
    </a>
        <a href="{{ url('') }}/dashboard/accounthistory" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
</svg>
 Transactions
    </a>
    <a href="{{ url('') }}/dashboard/account-settings" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
        bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
</svg>
 Settings
    </a>
    <button @click="$dispatch('open-mail-support')" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"></path>
</svg>
 Support
    </button>
</div>

    <div class="mb-6">
    <h2 class="text-xl font-bold text-content-primary">Markets</h2>
            <p class="text-sm text-content-secondary mt-1">Browse and trade available assets</p>
    </div>

    
    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-3 hover:border-surface-border-light transition-colors flex items-center gap-3">
    <div class="p-2 rounded-lg bg-primary-subtle shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"></path>
</svg>
    </div>
    <div class="min-w-0">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Total Assets</p>
        <p class="text-lg font-bold text-content-primary">{{ $totalAssets }}</p>
            </div>
</div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-3 hover:border-surface-border-light transition-colors flex items-center gap-3">
    <div class="p-2 rounded-lg bg-gain/10 shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"></path>
</svg>
    </div>
    <div class="min-w-0">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Top Gainer</p>
        <p class="text-lg font-bold text-content-primary">{{ $topGainer }}</p>
                    <p class="text-xs font-medium text-gain">{{ $topGainerChange }}</p>
            </div>
</div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-3 hover:border-surface-border-light transition-colors flex items-center gap-3">
    <div class="p-2 rounded-lg bg-loss/10 shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-loss" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75"></path>
</svg>
    </div>
    <div class="min-w-0">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Top Loser</p>
        <p class="text-lg font-bold text-content-primary">{{ $topLoser }}</p>
            </div>
</div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-3 hover:border-surface-border-light transition-colors flex items-center gap-3">
    <div class="p-2 rounded-lg bg-primary-subtle shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
    </div>
    <div class="min-w-0">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide truncate">Active Markets</p>
        <p class="text-lg font-bold text-content-primary">{{ $activeClassCount }}</p>
            </div>
</div>
    </div>

    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        
        <div class="flex flex-wrap items-center gap-2" role="tablist" aria-label="Filter by asset class">
            <a href="{{ url('') }}/dashboard/markets" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ (! $class || $class === 'all') ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80' }}" role="tab" {{ (! $class || $class === 'all') ? 'aria-selected="true"' : 'aria-selected="false"' }}>
                All
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ (! $class || $class === 'all') ? 'bg-white/20 text-white' : 'bg-surface-base text-content-tertiary' }}">{{ $totalAssets }}</span>
            </a>
            <a href="{{ url('') }}/dashboard/markets?class=crypto" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $class === 'crypto' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80' }}" role="tab" {{ $class === 'crypto' ? 'aria-selected="true"' : 'aria-selected="false"' }}>
                Crypto
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ $class === 'crypto' ? 'bg-white/20 text-white' : 'bg-surface-base text-content-tertiary' }}">{{ $counts['crypto'] ?? 0 }}</span>
            </a>
            <a href="{{ url('') }}/dashboard/markets?class=forex" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $class === 'forex' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80' }}" role="tab" {{ $class === 'forex' ? 'aria-selected="true"' : 'aria-selected="false"' }}>
                Forex
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ $class === 'forex' ? 'bg-white/20 text-white' : 'bg-surface-base text-content-tertiary' }}">{{ $counts['forex'] ?? 0 }}</span>
            </a>
            <a href="{{ url('') }}/dashboard/markets?class=stock" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $class === 'stock' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80' }}" role="tab" {{ $class === 'stock' ? 'aria-selected="true"' : 'aria-selected="false"' }}>
                Stocks
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ $class === 'stock' ? 'bg-white/20 text-white' : 'bg-surface-base text-content-tertiary' }}">{{ $counts['stock'] ?? 0 }}</span>
            </a>
            <a href="{{ url('') }}/dashboard/markets?class=etf" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $class === 'etf' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80' }}" role="tab" {{ $class === 'etf' ? 'aria-selected="true"' : 'aria-selected="false"' }}>
                ETFs
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ $class === 'etf' ? 'bg-white/20 text-white' : 'bg-surface-base text-content-tertiary' }}">{{ $counts['etf'] ?? 0 }}</span>
            </a>
            <a href="{{ url('') }}/dashboard/markets?class=index" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $class === 'index' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80' }}" role="tab" {{ $class === 'index' ? 'aria-selected="true"' : 'aria-selected="false"' }}>
                Indices
                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ $class === 'index' ? 'bg-white/20 text-white' : 'bg-surface-base text-content-tertiary' }}">{{ $counts['index'] ?? 0 }}</span>
            </a>
        </div>

        
        <form method="GET" action="{{ url('') }}/dashboard/markets" class="relative flex-shrink-0">
            @if ($class)
                <input type="hidden" name="class" value="{{ $class }}">
            @endif
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-content-tertiary absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
</svg>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search by name or symbol..." class="w-full sm:w-64 pl-9 pr-4 py-2 text-sm bg-surface-overlay border border-surface-border rounded-lg text-content-primary placeholder-content-tertiary focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none" aria-label="Search assets">
        </form>
    </div>

    
            
        <div class="hidden md:block bg-surface-raised border border-surface-border rounded-xl overflow-hidden mb-6">
            <table class="w-full text-sm" role="table">
                <caption class="sr-only">Available trading assets with prices and market data</caption>
                <thead>
                    <tr class="border-b border-surface-border">
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Asset</th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider">24h Change</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Class</th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse ($items as $item)
                        <tr class="hover:bg-surface-overlay/50 transition-colors group">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if ($item['img'])
                                        <img src="{{ $item['img'] }}" alt="" class="w-8 h-8 rounded-full bg-surface-overlay" loading="lazy">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-surface-overlay bg-primary/15 text-primary flex items-center justify-center font-semibold text-xs">&#9679;</div>
                                    @endif
                                    <div>
                                        <span class="text-sm font-semibold text-content-primary">{{ $item['name'] }}</span>
                                        <span class="text-xs text-content-tertiary ml-1">{{ $item['symbol'] }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <span class="text-sm font-medium text-content-primary">
                                    @if ($item['price']) ${{ $item['price'] }} @endif
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                @if ($item['change'])
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold {{ str_starts_with($item['change'], '-') ? 'text-loss' : 'text-gain' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="{{ str_starts_with($item['change'], '-') ? 'M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75' : 'M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941' }}"></path>
</svg>
                                        {{ $item['change'] }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 text-[10px] font-medium rounded-full bg-surface-overlay text-content-secondary capitalize">
                                    {{ $item['class'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ url('') }}/dashboard/trade?asset={{ $item['id'] }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg bg-primary hover:bg-primary-dark text-content-inverse transition-colors opacity-0 group-hover:opacity-100 focus:opacity-100">
                                    Trade
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"></path>
</svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center">
                                <p class="text-sm font-medium text-content-secondary">No assets found</p>
                                <p class="text-xs text-content-tertiary mt-1">Try adjusting your search or filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
            @forelse ($items as $item)
                <a href="{{ url('') }}/dashboard/trade?asset={{ $item['id'] }}" class="bg-surface-raised border border-surface-border rounded-xl p-4 hover:bg-surface-overlay/50 transition-colors block">
                    <div class="flex items-center gap-3 mb-3">
                        @if ($item['img'])
                            <img src="{{ $item['img'] }}" alt="" class="w-10 h-10 rounded-full bg-surface-overlay" loading="lazy">
                        @else
                            <div class="w-10 h-10 rounded-full bg-surface-overlay bg-primary/15 text-primary flex items-center justify-center font-semibold text-xs">&#9679;</div>
                        @endif
                        <div class="min-w-0 flex-1">
                            <span class="text-sm font-semibold text-content-primary block truncate" title="{{ $item['name'] }}">{{ $item['name'] }}</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-content-tertiary">{{ $item['symbol'] }}</span>
                                <span class="px-1.5 py-0.5 text-[10px] font-medium rounded bg-surface-overlay text-content-tertiary capitalize">{{ $item['class'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="text-lg font-bold text-content-primary">
                            @if ($item['price']) ${{ $item['price'] }} @endif
                        </span>
                        @if ($item['change'])
                            <span class="inline-flex items-center gap-0.5 px-2 py-0.5 text-xs font-semibold rounded-full {{ str_starts_with($item['change'], '-') ? 'bg-loss/10 text-loss' : 'bg-gain/10 text-gain' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="{{ str_starts_with($item['change'], '-') ? 'M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75' : 'M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941' }}"></path>
</svg>
                                {{ $item['change'] }}
                            </span>
                        @endif
                    </div>
                </a>
            @empty
                <p class="text-sm text-content-secondary col-span-full bg-surface-raised border border-surface-border rounded-xl p-6 text-center">No assets found. Try adjusting your search or filter.</p>
            @endforelse
        </div>

        </div>

@endsection

@push('head')
<style>[wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {display:none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {animation-duration: 50000s;animation-name: livewireautofill;}@keyframes livewireautofill { from {} }</style>
@endpush