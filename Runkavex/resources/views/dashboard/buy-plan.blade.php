@php
    $active = 'buy-plan';
    $headerTitle = 'Investment Plans';
    $drawerShouldOpen = (bool) (session('success') || $errors->any());
    $lastPlan = session('last_plan');
@endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Investment Plans')

@section('content')

        
        

        <div class="p-4 lg:p-6 space-y-6">
            
    <div>
    </div>    <div>
    </div>

    
    <!---
<div class="w-full overflow-hidden rounded-lg border border-surface-border bg-surface-raised mb-6">
    
    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
        {
            "symbols": [
                {"proName": "FOREXCOM:SPXUSD", "title": "S&P 500 Index"},
                {"proName": "FOREXCOM:NSXUSD", "title": "US 100 Cash CFD"},
                {"proName": "FX_IDC:EURUSD", "title": "EUR to USD"},
                {"proName": "BITSTAMP:BTCUSD", "title": "Bitcoin"},
                {"proName": "BITSTAMP:ETHUSD", "title": "Ethereum"},
                {"proName": "FOREXCOM:UKXGBP", "title": "UK 100"}
            ],
            "showSymbolLogo": true,
            "isTransparent": true,
            "displayMode": "adaptive",
            "colorTheme": "dark",
            "locale": "en"
        }
        </script>
    </div>
    
</div>
--->
    
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
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
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
    <h2 class="text-xl font-bold text-content-primary">Investment Plans</h2>
            <p class="text-sm text-content-secondary mt-1">{{ count($plans) }} plans available</p>
    </div>

    
    <div class="flex items-center justify-end gap-3 mb-6">
        <a href="{{ url('') }}/dashboard/myplans/All" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"></path>
</svg>
            My Plans
        </a>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
@foreach($plans as $plan)
                                <div class="rounded-xl bg-surface-raised border border-primary hover:border-primary overflow-hidden transition-all shadow-primary/5 shadow-lg" x-data="{
                    amount: {{ $plan['min'] }},
                    min: {{ $plan['min'] }},
                    max: {{ $plan['max'] }},
                    rate: {{ $plan['interest'] }},
                    type: 'Percentage',
                    interval: '{{ $plan['interval'] }}',
                    get roi() {
                        let amt = Math.max(this.min, Math.min(this.max, this.amount || this.min));
                        return this.type === 'Percentage' ? (amt * this.rate / 100).toFixed(2) : parseFloat(this.rate).toFixed(2);
                    },
                    get projected() {
                        let r = parseFloat(this.roi);
                        let multipliers = {'Monthly': 1, 'Weekly': 4.3, 'Daily': 30, 'Hourly': 720, 'Every 30 Minutes': 1440};
                        let m = multipliers[this.interval] || 30;
                        return (r * m).toFixed(2);
                    }
                 }">
                
                <div class="p-6 text-center border-b border-surface-border bg-primary/5">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"></path>
</svg>
                    </div>
                    <h3 class="text-lg font-bold text-content-primary">{{ $plan['name'] }}</h3>
                                            @if($plan['badge'])
                                            <span class="inline-block mt-1 px-2.5 py-0.5 text-xs font-semibold rounded-full bg-primary/10 text-primary">{{ $plan['badge'] }}</span>
                                            @endif
                                        <div class="mt-3">
                        <span class="text-3xl font-bold text-primary">{{ $plan['interest'] }}%</span>
                        <span class="text-sm text-content-secondary ml-1">{{ $plan['interval'] }}</span>
                    </div>
                </div>

                
                <div class="p-6 space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-content-tertiary flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3"></path>
</svg>
 Minimum
                        </span>
                        <span class="text-content-primary font-semibold">${{ number_format($plan['min'], 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-content-tertiary flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"></path>
</svg>
 Maximum
                        </span>
                        <span class="text-content-primary font-semibold">${{ number_format($plan['max'], 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-content-tertiary flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
 Duration
                        </span>
                        <span class="text-content-primary font-semibold">{{ $plan['duration'] }} Days</span>
                    </div>
                                    </div>

                
                <div class="px-6 pb-4">
                    <div class="rounded-lg bg-surface-overlay border border-surface-border p-3">
                        <label class="block text-xs font-medium text-content-tertiary mb-1.5">Calculate Your Returns</label>
                        <input type="number" x-model.number="amount" :min="min" :max="max" :placeholder="'$' + min + ' - $' + max" class="w-full px-3 py-2 rounded-md bg-surface-base border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary mb-2" min="{{ $plan['min'] }}" max="{{ $plan['max'] }}" placeholder="${{ number_format($plan['min'], 2) }} - ${{ number_format($plan['max'], 2) }}">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-content-tertiary">Per {{ $plan['interval'] }}</span>
                            <span class="text-gain font-semibold" x-text="'$' + roi">${{ number_format($plan['min'] * $plan['interest'] / 100, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs mt-1">
                            <span class="text-content-tertiary">Est. Monthly</span>
                            <span class="text-primary font-semibold" x-text="'$' + projected">${{ number_format($plan['min'] * $plan['interest'] / 100 * 30, 2) }}</span>
                        </div>
                    </div>
                </div>

                
                <div class="px-6 pb-6">
                    <button type="button" onclick="openInvestDrawer('{{ $plan['name'] }}')" class="w-full py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors">
                        Invest Now
                    </button>
                </div>
            </div>
            @endforeach
            </div>

    
    
    <div x-data="{ open: {{ $drawerShouldOpen ? 'true' : 'false' }}, selected: null, plans: window.__investmentPlans, lastPlan: window.__lastPlan }" x-init="selected = lastPlan ? (plans.find(p => p.name === lastPlan) || plans[0]) : plans[0]" x-on:open-invest-drawer.window="open = true" x-on:keydown.escape.window="open = false">
        
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/60 z-40" @click="open = false" style="display: none;"></div>
        
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed inset-y-0 right-0 z-50 w-full max-w-2xl bg-surface-base border-l border-surface-border overflow-y-auto" style="display: none;">
            
            <div class="sticky top-0 z-10 bg-surface-base border-b border-surface-border px-6 py-4 flex items-center justify-between">
                <h2 class="text-lg font-bold text-content-primary">Invest in Plan</h2>
                <button @click="open = false" class="p-2 rounded-lg hover:bg-surface-overlay text-content-tertiary hover:text-content-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
</svg>
                </button>
            </div>
            
            <div class="px-6 pb-6">
                <form method="POST" action="{{ url('/dashboard/buy-plan') }}" class="mt-6">
                    @csrf
                    @if(session('success'))
                    <div class="p-3 rounded-lg bg-gain/10 border border-gain/20 text-gain text-xs font-medium mb-4">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="p-3 rounded-lg bg-loss/10 border border-loss/20 text-loss text-xs mb-4">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                    <div>
    </div>                    <div>
    </div>

                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-content-secondary mb-2">Select Investment Plan</label>
                        <select name="plan_name" required x-init="selected = plans.find(p => p.name === $el.value) || plans[0]" @change="selected = plans.find(p => p.name === $event.target.value) || plans[0]" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-3 text-content-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                            @foreach($plans as $plan)
                            <option value="{{ $plan['name'] }}" @if(old('plan_name', $lastPlan) === $plan['name']) selected @endif class="bg-surface-overlay">{{ $plan['name'] }} — {{ $plan['interest'] }}% / {{ $plan['duration'] }} days</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-content-tertiary">Available balance: ${{ number_format($user->balance, 2) }}</p>
                    </div>

                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-content-secondary mb-3">Choose Quick Amount to Invest</label>
                        <div class="flex flex-wrap gap-2">
                                                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 100" class="px-4 py-2 bg-surface-overlay border border-surface-border rounded-lg text-sm text-content-primary hover:border-primary/50 hover:bg-primary/10 transition-all">
                                    $100.00                                </button>
                                                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 250" class="px-4 py-2 bg-surface-overlay border border-surface-border rounded-lg text-sm text-content-primary hover:border-primary/50 hover:bg-primary/10 transition-all">
                                    $250.00                                </button>
                                                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 500" class="px-4 py-2 bg-surface-overlay border border-surface-border rounded-lg text-sm text-content-primary hover:border-primary/50 hover:bg-primary/10 transition-all">
                                    $500.00                                </button>
                                                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 1000" class="px-4 py-2 bg-surface-overlay border border-surface-border rounded-lg text-sm text-content-primary hover:border-primary/50 hover:bg-primary/10 transition-all">
                                    $1,000.00                                </button>
                                                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 1500" class="px-4 py-2 bg-surface-overlay border border-surface-border rounded-lg text-sm text-content-primary hover:border-primary/50 hover:bg-primary/10 transition-all">
                                    $1,500.00                                </button>
                                                            <button type="button" onclick="document.querySelector('input[name=amount]').value = 2000" class="px-4 py-2 bg-surface-overlay border border-surface-border rounded-lg text-sm text-content-primary hover:border-primary/50 hover:bg-primary/10 transition-all">
                                    $2,000.00                                </button>
                                                    </div>
                    </div>

                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-content-secondary mb-2">Or Enter Your Amount</label>
                        <input type="number" name="amount" required step="0.01" min="1" placeholder="0.00" value="{{ old('amount') }}" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-3 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                    </div>

                    
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-3">Choose Payment Method</label>
                        <button wire:click="chanegePaymentMethod('Account Balance')" class="w-full flex items-center gap-4 p-4 rounded-lg border transition-all cursor-pointer
                                bg-primary/10 border-primary/50">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                                <span class="text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3"></path>
</svg>
                                </span>
                            </div>
                            <div class="text-left">
                                <p class="text-content-primary font-medium">Account Balance</p>
                                <p class="text-sm text-content-secondary">$0.00</p>
                            </div>
                                                            <div class="ml-auto">
                                    <span class="text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                                    </span>
                                </div>
                                                    </button>
                    </div>
                </div>
            </div>

            
            <div>
                <div class="bg-surface-raised border border-surface-border rounded-xl p-6 sticky top-24">
                    <h3 class="text-content-primary font-semibold mb-4">Your Investment Details</h3>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-content-tertiary mb-1">Name of Plan</p>
                            <p class="text-sm text-primary font-medium" x-text="selected ? selected.name : ''">Elite Plan</p>
                        </div>
                        <div>
                            <p class="text-xs text-content-tertiary mb-1">Plan Price</p>
                            <p class="text-sm text-primary font-medium" x-text="selected ? '$' + Number(selected.min).toLocaleString('en-US') : ''">$10,000.00</p>
                        </div>
                        <div>
                            <p class="text-xs text-content-tertiary mb-1">Duration</p>
                            <p class="text-sm text-primary font-medium" x-text="selected ? selected.duration + ' Days' : ''">45 Days</p>
                        </div>
                        <div>
                            <p class="text-xs text-content-tertiary mb-1">Profit</p>
                            <p class="text-sm text-primary font-medium">
                                <span x-text="selected ? selected.interest + '%' : ''">55%</span>
                                <span x-text="selected ? selected.interval : ''">Daily</span>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-content-tertiary mb-1">Minimum Deposit</p>
                            <p class="text-sm text-primary font-medium" x-text="selected ? '$' + Number(selected.min).toLocaleString('en-US') : ''">$10,000.00</p>
                        </div>
                        <div>
                            <p class="text-xs text-content-tertiary mb-1">Maximum Deposit</p>
                            <p class="text-sm text-primary font-medium" x-text="selected ? '$' + Number(selected.max).toLocaleString('en-US') : ''">$1,000,000.00</p>
                        </div>
                        <div>
                            <p class="text-xs text-content-tertiary mb-1">Minimum Return</p>
                            <p class="text-sm text-primary font-medium" x-text="selected ? selected.interest + '%' : ''">55%</p>
                        </div>
                        <div>
                            <p class="text-xs text-content-tertiary mb-1">Payout Interval</p>
                            <p class="text-sm text-primary font-medium" x-text="selected ? selected.interval : ''">Daily</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-content-tertiary mb-1">Bonus</p>
                            <p class="text-sm text-primary font-medium">$0.00</p>
                        </div>
                    </div>

                    <div class="border-t border-surface-border pt-4 mb-3">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-content-secondary">Payment method</span>
                            <span class="text-sm text-primary">Account Balance</span>
                        </div>
                    </div>

                    <div class="border-t border-surface-border pt-4 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-content-primary font-semibold">Available Balance</span>
                            <span class="text-primary font-bold text-lg">${{ number_format($user->balance, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-content-inverse font-semibold py-3 px-4 rounded-lg transition-colors">
                        Confirm &amp; Invest
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

                </div>
        </div>
    </div>

        </div>

        
        
    
@endsection

@push('head')
<script>
window.__investmentPlans = @json($plans);
window.__lastPlan = @json($lastPlan);
function openInvestDrawer(name) {
    if (name) {
        var sel = document.querySelector('select[name="plan_name"]');
        if (sel) {
            sel.value = name;
            sel.dispatchEvent(new Event('change'));
        }
    }
    window.dispatchEvent(new CustomEvent('open-invest-drawer'));
}
</script>
<style>[wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {display:none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {animation-duration: 50000s;animation-name: livewireautofill;}@keyframes livewireautofill { from {} }</style>
@endpush
