@php $active = 'trade'; $headerTitle = 'Trade Center'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Trade Center')

@section('content')

        
        

        <div class="p-4 lg:p-6 space-y-6">
            
    
    <style>
        @keyframes  preloader-progress {
            from { width: 0% }
            to   { width: 100% }
        }
    </style>
    <div x-data="{ loading: true }" x-show="loading" x-init="setTimeout(() =&gt; loading = false, 2000)" @chart-ready.window="loading = false" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-[60] bg-surface-base flex items-center justify-center" style="display: none;">
        <div class="flex flex-col items-center gap-5">
            
            <div class="relative">
                <div class="w-12 h-12 rounded-full border-[3px] border-surface-border border-t-primary animate-spin"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                </div>
            </div>
            
            <div class="text-center">
                <p class="text-content-primary text-sm font-semibold tracking-wide">Loading Trading Platform</p>
                <p class="text-content-tertiary text-xs mt-1.5">Preparing your trading environmentâ€¦</p>
            </div>
            
            <div class="w-48 h-[3px] rounded-full bg-surface-overlay overflow-hidden">
                <div class="h-full bg-primary rounded-full" style="animation: preloader-progress 2.5s ease-in-out forwards"></div>
            </div>
        </div>
    </div>

    <div>
    </div>    <div>
    </div>
    <div>
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

    
    @if(session('success'))
        <div class="mb-4 flex items-center gap-3 border border-gain/20 bg-gain/10 text-gain rounded-lg px-4 py-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m9 12.75 3 3L20.25 6.75M4.5 12.75a7.5 7.5 0 1 0 15 0 7.5 7.5 0 0 0-15 0Z"></path>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 flex items-center gap-3 border border-loss/20 bg-loss/10 text-loss rounded-lg px-4 py-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
</svg>
            <span>{{ session('error') }}</span>
        </div>
    @elseif($errors->any())
        <div class="mb-4 flex items-center gap-3 border border-loss/20 bg-loss/10 text-loss rounded-lg px-4 py-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
</svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Trading</h2>
            <p class="text-sm text-content-secondary mt-1">Execute binary &amp; spot trades on live markets</p>
        </div>
        <a href="{{ url('') }}/dashboard/tradinghistory" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
            Trade History
        </a>
    </div>

    
    <div x-data="tradePanel()" x-init="init()" class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        
        <div class="lg:col-span-4 space-y-4">

            
            <div class="rounded-xl bg-surface-raised border border-surface-border overflow-hidden">
                <div class="px-5 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button @click="isDemo = false" :class="!isDemo ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary'" class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors bg-primary text-content-inverse">
                            Live
                        </button>
                        <button @click="isDemo = true" :class="isDemo ? 'bg-warning text-surface-base' : 'bg-surface-overlay text-content-secondary'" class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors bg-surface-overlay text-content-secondary">
                            Demo
                        </button>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-content-tertiary" x-text="isDemo ? 'Demo Balance' : 'Live Balance'"></span>
                        <div class="text-sm font-bold text-gain" :class="isDemo ? 'text-warning' : 'text-gain'">
                            <span x-show="!isDemo" style="display: none;">$0.00</span>
                            <span x-show="isDemo" style="display: none;">$10,000.00</span>
                        </div>
                    </div>
                </div>
                <template x-if="isDemo">
                    <div class="px-5 py-2 bg-warning/10 border-t border-warning/20 text-xs text-warning font-medium text-center">
                        Demo Mode â€” Virtual funds, no real money at risk
                    </div>
                </template>
            </div>

            
            <div class="rounded-xl bg-surface-raised border border-surface-border overflow-hidden">
                <div class="px-5 py-3 border-b border-surface-border flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full animate-pulse bg-gain" :class="isDemo ? 'bg-warning' : 'bg-gain'"></div>
                        <span class="text-sm font-semibold text-gain" :class="isDemo ? 'text-warning' : 'text-gain'" x-text="isDemo ? 'Demo Trading' : 'Live Trading'"></span>
                    </div>
                    
                    <div class="flex gap-1">
                        <button @click="tradeType = 'binary'" :class="tradeType === 'binary' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary'" class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors bg-primary text-content-inverse">
                            Binary
                        </button>
                        <button @click="tradeType = 'spot'" :class="tradeType === 'spot' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary'" class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors bg-surface-overlay text-content-secondary">
                            Spot
                        </button>
                    </div>
                </div>

                <form id="tradeForm" action="{{ url('') }}/dashboard/trades" method="POST" class="p-5 space-y-4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                    <input type="hidden" name="trade_type" :value="tradeType" value="">
                    <input type="hidden" name="is_demo" :value="isDemo ? 1 : 0" value="">
                    <input type="hidden" name="action" x-ref="tradeAction">

                    
                    <div>
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Asset Class</label>
                        <div class="flex flex-wrap gap-1">
                            <template x-for="cls in assetClasses" :key="cls.key">
                                <button type="button" @click="filterClass = cls.key; filterAssets()" :class="filterClass === cls.key ? 'bg-primary text-content-inverse border-primary' : 'bg-surface-overlay text-content-secondary border-surface-border hover:text-content-primary'" class="px-2.5 py-1 text-xs font-medium rounded-lg border transition-colors" x-text="cls.label">
                                </button>
                            </template>
                        </div>
                    </div>

                    
                    <div x-data="{ pickerOpen: false }" @click.outside="pickerOpen = false" class="relative">
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Select Asset</label>
                        <input type="hidden" name="trading_asset_id" :value="selectedAssetId" value="">
                        <button type="button" @click="pickerOpen = !pickerOpen" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-sm text-content-primary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-colors text-left">
                            <template x-if="selectedAsset &amp;&amp; selectedAsset.logo_url">
                                <img :src="selectedAsset.logo_url" class="w-5 h-5 rounded-full flex-shrink-0" :alt="selectedAsset.symbol">
                            </template>
                            <template x-if="selectedAsset &amp;&amp; !selectedAsset.logo_url">
                                <span class="w-5 h-5 rounded-full bg-primary/20 text-primary text-[10px] font-bold flex items-center justify-center flex-shrink-0" x-text="selectedAsset.symbol.substring(0,2)"></span>
                            </template>
                            <template x-if="!selectedAsset">
                                <span class="w-5 h-5 rounded-full bg-surface-border flex-shrink-0"></span>
                            </template><span class="w-5 h-5 rounded-full bg-surface-border flex-shrink-0"></span>
                            <span class="flex-1 truncate text-content-tertiary" x-text="selectedAsset ? selectedAsset.symbol + ' â€” ' + selectedAsset.name : 'â€” Choose an asset â€”'" :class="selectedAsset ? 'text-content-primary' : 'text-content-tertiary'"></span>
                            <svg class="w-4 h-4 text-content-tertiary flex-shrink-0 transition-transform" :class="pickerOpen &amp;&amp; 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path></svg>
                        </button>
                        <div x-show="pickerOpen" x-transition.opacity="" class="absolute z-50 mt-1 w-full max-h-56 overflow-y-auto rounded-lg bg-surface-overlay border border-surface-border shadow-xl" style="display: none;">
                            <template x-for="asset in filteredAssets" :key="asset.id">
                                <button type="button" @click="selectedAssetId = asset.id; onAssetChange(); pickerOpen = false" class="w-full flex items-center gap-2.5 px-3 py-2 hover:bg-surface-border/40 transition-colors" :class="selectedAssetId == asset.id &amp;&amp; 'bg-primary/10'">
                                    <template x-if="asset.logo_url">
                                        <img :src="asset.logo_url" class="w-5 h-5 rounded-full flex-shrink-0" :alt="asset.symbol">
                                    </template>
                                    <template x-if="!asset.logo_url">
                                        <span class="w-5 h-5 rounded-full bg-primary/20 text-primary text-[10px] font-bold flex items-center justify-center flex-shrink-0" x-text="asset.symbol.substring(0,2)"></span>
                                    </template>
                                    <span class="text-sm text-content-primary font-medium" x-text="asset.symbol"></span>
                                    <span class="text-xs text-content-tertiary truncate" x-text="asset.name"></span>
                                    <span class="ml-auto text-xs font-medium" :class="(asset.price_change_pct_24h ?? 0) &gt;= 0 ? 'text-gain' : 'text-loss'" x-text="'$' + formatPrice(asset.price)"></span>
                                </button>
                            </template>\n<div x-show="filteredAssets.length === 0" class="px-3 py-4 text-xs text-content-tertiary text-center" style="display: none;">No assets in this class</div>
                        </div>
                    </div>

                    
                    <div x-show="selectedAsset" class="flex items-center justify-between px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border" style="display: none;">
                        <div class="flex items-center gap-2">
                            <template x-if="selectedAsset &amp;&amp; selectedAsset.logo_url">
                                <img :src="selectedAsset.logo_url" class="w-5 h-5 rounded-full" :alt="selectedAsset.symbol">
                            </template>
                            <span class="text-xs text-content-secondary">Entry Price</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-content-primary" x-text="'$' + formatPrice(selectedAsset?.price)"></span>
                            <span class="text-xs ml-1 text-gain" :class="(selectedAsset?.price_change_pct_24h ?? 0) &gt;= 0 ? 'text-gain' : 'text-loss'" x-text="((selectedAsset?.price_change_pct_24h ?? 0) &gt;= 0 ? '+' : '') + Number(selectedAsset?.price_change_pct_24h ?? 0).toFixed(2) + '%'"></span>
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Leverage</label>
                        <input type="hidden" name="leverage" :value="leverage" value="">
                        <div class="grid grid-cols-6 gap-1.5">
                            <template x-for="lev in leverageOptions" :key="lev">
                                <button type="button" @click="leverage = lev" :class="leverage === lev ? 'bg-primary text-content-inverse border-primary' : 'bg-surface-overlay text-content-secondary border-surface-border hover:bg-primary/10 hover:text-primary'" class="py-2 text-xs font-semibold rounded-lg border transition-colors text-center" x-text="lev + 'x'">
                                </button>
                            </template>
                        </div>
                    </div>

                    
                    <div x-show="tradeType === 'binary'" style="display: none;">
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Duration</label>
                        <input type="hidden" name="duration" :value="duration" value="">
                        <div class="grid grid-cols-7 gap-1.5">
                            <template x-for="d in durationOptions" :key="d.value">
                                <button type="button" @click="duration = d.value" :class="duration === d.value ? 'bg-primary text-content-inverse border-primary' : 'bg-surface-overlay text-content-secondary border-surface-border hover:bg-primary/10 hover:text-primary'" class="py-2 text-xs font-semibold rounded-lg border transition-colors text-center" x-text="d.label">
                                </button>
                            </template>
                        </div>
                    </div>
                    <template x-if="tradeType === 'spot'">
                        <p class="text-xs text-content-tertiary italic">Spot trades have no expiry â€” request close anytime, settled by admin.</p>
                    </template>

                    
                    <div>
                        <label class="block text-xs font-medium text-content-secondary mb-1.5">Amount (USD)</label>
                        <input type="number" name="amount" x-model.number="amount" step="0.01" min="1" required="" placeholder="Enter trade amount" class="w-full px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary transition-colors">
                    </div>

                    
                    <div x-show="amount &gt; 0 &amp;&amp; leverage &gt; 0" class="rounded-lg bg-surface-overlay border border-surface-border p-3" style="display: none;">
                        <div class="text-xs text-content-tertiary mb-2">Potential Outcome Preview</div>
                        <div class="grid grid-cols-2 gap-3 text-center">
                            <div>
                                <div class="text-xs text-content-secondary mb-0.5">If WIN</div>
                                <span class="text-sm font-bold text-gain" x-text="'+$' + (amount * leverage / 100).toFixed(2)"></span>
                            </div>
                            <div>
                                <div class="text-xs text-content-secondary mb-0.5">If LOSS</div>
                                <span class="text-sm font-bold text-loss" x-text="'-$' + (amount * leverage / 100).toFixed(2)"></span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <button type="button" @click="confirmTrade('buy')" class="py-3 rounded-lg bg-gain hover:bg-gain/80 text-white text-sm font-bold transition-colors flex items-center justify-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"></path>
</svg>
                            Buy / Long
                        </button>
                        <button type="button" @click="confirmTrade('sell')" class="py-3 rounded-lg bg-loss hover:bg-loss/80 text-white text-sm font-bold transition-colors flex items-center justify-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l6.75-6.75M2.25 12.75 9 19.5l6.75-6.75"></path>
</svg>
                            Sell / Short
                        </button>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="lg:col-span-8 rounded-xl bg-surface-raised border border-surface-border overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
                <h3 class="text-sm font-semibold text-content-primary">Live Chart</h3>
                <span class="text-xs text-content-tertiary ml-auto" x-text="selectedAsset ? selectedAsset.symbol : ''"></span>
            </div>
            <div id="tv_chart_wrapper" style="height:685px;">
                <div class="tradingview-widget-container" style="height:100%;width:100%">
                    <iframe scrolling="no" allowtransparency="true" frameborder="0" src="https://www.tradingview-widget.com/embed-widget/advanced-chart/?locale=en#%7B%22autosize%22%3Atrue%2C%22symbol%22%3A%22NASDAQ%3AAAPL%22%2C%22interval%22%3A%221%22%2C%22timezone%22%3A%22Etc%2FUTC%22%2C%22theme%22%3A%22dark%22%2C%22style%22%3A%221%22%2C%22backgroundColor%22%3A%22rgba(22%2C%2026%2C%2030%2C%201)%22%2C%22gridColor%22%3A%22rgba(42%2C%2047%2C%2054%2C%200.3)%22%2C%22allow_symbol_change%22%3Atrue%2C%22hide_side_toolbar%22%3Afalse%2C%22studies%22%3A%5B%22MACD%40tv-basicstudies%22%5D%2C%22support_host%22%3A%22https%3A%2F%2Fwww.tradingview.com%22%2C%22width%22%3A%22100%25%22%2C%22height%22%3A%22100%25%22%2C%22utm_source%22%3A%22www.runkavexcapital.com%22%2C%22utm_medium%22%3A%22widget%22%2C%22utm_campaign%22%3A%22advanced-chart%22%2C%22page-uri%22%3A%22www.runkavexcapital.com%2Fdashboard%2Ftrade%22%7D" title="advanced chart TradingView widget" lang="en" style="user-select: none; box-sizing: border-box; display: block; height: 100%; width: 100%;"></iframe>
                    
                <style>
	.tradingview-widget-copyright {
		font-size: 13px !important;
		line-height: 32px !important;
		text-align: center !important;
		vertical-align: middle !important;
		/* @mixin sf-pro-display-font; */
		font-family: -apple-system, BlinkMacSystemFont, 'Trebuchet MS', Roboto, Ubuntu, sans-serif !important;
		color: #B2B5BE !important;
	}

	.tradingview-widget-copyright .blue-text {
		color: #2962FF !important;
	}

	.tradingview-widget-copyright a {
		text-decoration: none !important;
		color: #B2B5BE !important;
	}

	.tradingview-widget-copyright a:visited {
		color: #B2B5BE !important;
	}

	.tradingview-widget-copyright a:hover .blue-text {
		color: #1E53E5 !important;
	}

	.tradingview-widget-copyright a:active .blue-text {
		color: #1848CC !important;
	}

	.tradingview-widget-copyright a:visited .blue-text {
		color: #2962FF !important;
	}
	</style></div>
            </div>
        </div>
    </div>

    
    <div class="mt-6 rounded-xl bg-surface-raised border border-surface-border overflow-hidden" x-data="{ tradeTab: 'open' }">
        <div class="px-5 py-3 border-b border-surface-border flex items-center justify-between">
            <h3 class="text-sm font-semibold text-content-primary">Active Trades</h3>
            <div class="flex gap-1">
                <button @click="tradeTab = 'open'" :class="tradeTab === 'open' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary'" class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors bg-primary text-content-inverse">
                    Open ({{ $openTrades->count() }})
                </button>
                <button @click="tradeTab = 'closed'" :class="tradeTab === 'closed' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary'" class="px-3 py-1.5 text-xs font-medium rounded-lg transition-colors bg-surface-overlay text-content-secondary hover:text-content-primary">
                    Closed ({{ $closedTrades->count() }})
                </button>
            </div>
        </div>

        
        <div x-show="tradeTab === 'open'" class="overflow-x-auto">
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
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($openTrades as $trade)
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
                            <td class="px-4 py-3 text-content-secondary">
                                @if($trade->trade_type === 'binary')
                                    <span class="trade-countdown font-mono text-xs" data-expires="{{ $trade->expires_at?->format('Y-m-d H:i:s') }}" data-trade-id="{{ $trade->id }}">--</span>
                                @else
                                    <span class="text-xs">No expiry</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($trade->trade_type === 'spot')
                                    <button type="button" @click="requestCloseSpot({{ $trade->id }})" class="text-primary hover:text-primary-light text-xs font-medium transition-colors">Request Close</button>
                                @else
                                    <span class="text-xs text-content-tertiary">{{ $trade->is_demo ? 'DEMO' : 'Auto' }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="px-4 py-8 text-center text-content-tertiary">No open trades found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-5 py-3"></div>
        </div>

        
        <div x-show="tradeTab === 'closed'" class="overflow-x-auto" style="display: none;">
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
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Exit</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Result</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">P/L</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Settled</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($closedTrades as $trade)
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
                            <td class="px-4 py-3 text-content-primary">{{ isset($prices[$trade->symbol]) ? $prices[$trade->symbol] : $trade->entry_price }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded uppercase {{ $trade->result === 'win' ? 'bg-gain/10 text-gain' : ($trade->result === 'loss' ? 'bg-loss/10 text-loss' : 'bg-surface-overlay text-content-tertiary') }}">{{ $trade->result }}</span>
                            </td>
                            <td class="px-4 py-3 font-medium {{ $trade->pnl >= 0 ? 'text-gain' : 'text-loss' }}">{{ $trade->pnl >= 0 ? '+' : '' }}{{ number_format($trade->pnl, 2) }}</td>
                            <td class="px-4 py-3 text-content-tertiary">{{ $trade->closed_at?->format('M j, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="11" class="px-4 py-8 text-center text-content-tertiary">No closed trades found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-5 py-3"></div>
        </div>
    </div>

        </div>

        
        
    
@endsection

@push('head')
<style>[wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {display:none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {animation-duration: 50000s;animation-name: livewireautofill;}@keyframes livewireautofill { from {} }</style>
@endpush

@push('scripts')
<script type="text/javascript">
    function initChart(symbol) {
        symbol = symbol || 'NASDAQ:AAPL';
        const wrapper = document.getElementById('tv_chart_wrapper');
        if (!wrapper) return;

        // Clear existing content
        wrapper.innerHTML = '';

        // Build container
        var container = document.createElement('div');
        container.className = 'tradingview-widget-container';
        container.style.cssText = 'height:100%;width:100%';

        var widgetDiv = document.createElement('div');
        widgetDiv.className = 'tradingview-widget-container__widget';
        widgetDiv.style.cssText = 'height:100%;width:100%';
        container.appendChild(widgetDiv);

        // Create script element programmatically so the browser executes it
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js';
        script.async = true;
        script.textContent = JSON.stringify({
            autosize: true,
            symbol: symbol,
            interval: '1',
            timezone: 'Etc/UTC',
            theme: 'dark',
            style: '1',
            locale: 'en',
            backgroundColor: 'rgba(22, 26, 30, 1)',
            gridColor: 'rgba(42, 47, 54, 0.3)',
            allow_symbol_change: true,
            hide_side_toolbar: false,
            calendar: false,
            studies: ['MACD@tv-basicstudies'],
            support_host: 'https://www.tradingview.com'
        });
        container.appendChild(script);
        wrapper.appendChild(container);

        window.dispatchEvent(new Event('chart-ready'));
    }

    // Fire chart-ready once the initial widget loads
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            window.dispatchEvent(new Event('chart-ready'));
        }, 1500);
    });
</script>
<script>
    function tradePanel() {
        return {
            // State
            isDemo: false,
            tradeType: 'binary',
            filterClass: 'crypto',
            selectedAssetId: '',
            selectedAsset: null,
            leverage: 5,
            duration: 5,
            amount: 0,

            // Options
            leverageOptions: [2, 5, 10, 25, 50, 100],
            durationOptions: [
                { value: 1, label: '1m' },
                { value: 5, label: '5m' },
                { value: 15, label: '15m' },
                { value: 30, label: '30m' },
                { value: 60, label: '1h' },
                { value: 240, label: '4h' },
                { value: 1440, label: '1d' },
            ],
            assetClasses: [
                { key: 'crypto', label: 'Crypto' },
                { key: 'forex', label: 'Forex' },
                { key: 'stock', label: 'Stocks' },
                { key: 'etf', label: 'ETFs' },
                { key: 'index', label: 'Indices' },
            ],

            // Asset data from server
            allAssets: @json($markets),
            filteredAssets: [],

            init() {
                this.filterAssets();
            },

            filterAssets() {
                this.filteredAssets = this.allAssets.filter(a => a.asset_class === this.filterClass);
                // If current selection not in filtered list, clear it
                if (this.selectedAssetId && !this.filteredAssets.find(a => a.id == this.selectedAssetId)) {
                    this.selectedAssetId = '';
                    this.selectedAsset = null;
                }
            },

            onAssetChange() {
                const id = parseInt(this.selectedAssetId);
                this.selectedAsset = this.allAssets.find(a => a.id === id) || null;
                if (this.selectedAsset) {
                    this.updateChart(this.selectedAsset);
                }
            },

            updateChart(asset) {
                let cleanSymbol = asset.symbol
                    .toUpperCase()
                    .replace(/\//g, '')
                    .replace(/-/g, '')
                    .replace(/\s+/g, '');

                let tvSymbol = '';

                if (asset.asset_class === 'crypto') {
                    if (!cleanSymbol.endsWith('USDT')) {
                        cleanSymbol += 'USDT';
                    }
                    tvSymbol = 'BINANCE:' + cleanSymbol;
                } else if (asset.asset_class === 'forex') {
                    tvSymbol = 'FX:' + cleanSymbol;
                } else if (asset.asset_class === 'index') {
                    tvSymbol = 'TVC:' + cleanSymbol;
                } else if (asset.asset_class === 'etf') {
                    tvSymbol = 'AMEX:' + cleanSymbol;
                } else {
                    tvSymbol = 'NASDAQ:' + cleanSymbol;
                }

                console.log('Loading symbol:', tvSymbol);
                initChart(tvSymbol);
            },

            formatPrice(price) {
                if (!price) return '0.00';
                price = parseFloat(price);
                if (price >= 1) return price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                if (price >= 0.01) return price.toFixed(4);
                return price.toFixed(6);
            },

            confirmTrade(action) {
                if (!this.selectedAssetId) {
                    Swal.fire({ title: 'Select an Asset', text: 'Please choose an asset before placing a trade.', icon: 'info', background: '#161A1E', color: '#E8EAED' });
                    return;
                }
                if (!this.amount || this.amount <= 0) {
                    Swal.fire({ title: 'Enter Amount', text: 'Please enter a valid trade amount.', icon: 'info', background: '#161A1E', color: '#E8EAED' });
                    return;
                }

                const modeLabel = this.isDemo ? ' (DEMO)' : '';
                const typeLabel = this.tradeType === 'binary' ? 'Binary' : 'Spot';
                const profitLoss = (this.amount * this.leverage / 100).toFixed(2);

                const cs = '$';

                Swal.fire({
                    title: `Confirm ${action.toUpperCase()} ${typeLabel}${modeLabel}`,
                    html: `
                        <div style="text-align:left; font-size:13px; color:#9BA1A6;">
                            <p><strong>Asset:</strong> ${this.selectedAsset.symbol} â€” ${this.selectedAsset.name}</p>
                            <p><strong>Entry Price:</strong> ${cs}${this.formatPrice(this.selectedAsset.price)}</p>
                            <p><strong>Amount:</strong> ${cs}${Number(this.amount).toFixed(2)}</p>
                            <p><strong>Leverage:</strong> ${this.leverage}x</p>
                            ${this.tradeType === 'binary' ? '<p><strong>Duration:</strong> ' + this.durationOptions.find(d => d.value === this.duration)?.label + '</p>' : '<p><strong>Duration:</strong> No expiry (spot)</p>'}
                            <p><strong>Potential P/L:</strong> <span style="color:#22C55E">+${cs}${profitLoss}</span> / <span style="color:#EF4444">-${cs}${profitLoss}</span></p>
                        </div>
                    `,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: action === 'buy' ? '#22C55E' : '#EF4444',
                    cancelButtonColor: '#2E2E2E',
                    confirmButtonText: `${action.toUpperCase()} Now`,
                    cancelButtonText: "Cancel",
                    background: '#161A1E',
                    color: '#E8EAED'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$refs.tradeAction.value = action;
                        document.getElementById('tradeForm').submit();
                    }
                });
            }
        };
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const countdowns = document.querySelectorAll('.trade-countdown');
        if (countdowns.length === 0) return;

        setInterval(function() {
            countdowns.forEach(function(el) {
                const expires = new Date(el.dataset.expires).getTime();
                const now = Date.now();
                const diff = expires - now;

                if (diff <= 0) {
                    el.textContent = 'Settling...';
                    el.classList.add('text-warning');
                    // Auto-process expired binary trade
                    const tradeId = el.dataset.tradeId;
                    if (!el.dataset.processing) {
                        el.dataset.processing = 'true';
                        fetch("{{ url('') }}/dashboard/trades/process", {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: JSON.stringify({ trade_id: tradeId })
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.success) {
                                setTimeout(() => location.reload(), 1500);
                            }
                        });
                    }
                    return;
                }

                const h = Math.floor(diff / 3600000);
                const m = Math.floor((diff % 3600000) / 60000);
                const s = Math.floor((diff % 60000) / 1000);
                el.textContent = (h > 0 ? h + 'h ' : '') + m + 'm ' + s + 's';
            });
        }, 1000);
    });
</script>
<script>
    function requestCloseSpot(tradeId) {
        Swal.fire({
            title: 'Request Close?',
            text: 'This will send a close request to admin for settlement.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#2E2E2E',
            confirmButtonText: 'Yes, Request Close',
            background: '#161A1E',
            color: '#E8EAED'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ url('') }}/dashboard/trades/request-close", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ trade_id: tradeId })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({ title: 'Submitted', text: data.message, icon: 'success', background: '#161A1E', color: '#E8EAED' })
                            .then(() => location.reload());
                    } else {
                        Swal.fire({ title: 'Error', text: data.message, icon: 'error', background: '#161A1E', color: '#E8EAED' });
                    }
                });
            }
        });
    }
</script>
@endpush
