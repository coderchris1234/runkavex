@php $active = 'bot-trading'; $headerTitle = 'Bot Trading'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Bot Trading')

@section('content')

        
        

        <div class="p-4 lg:p-6 space-y-6">
            
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
--->    <div class="flex flex-wrap gap-2 mb-6">
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
    <h2 class="text-xl font-bold text-content-primary">Bot Trading</h2>
            <p class="text-sm text-content-secondary mt-1">Subscribe to automated trading bots and earn passive profits</p>
    </div>

    
    <div x-data="{ tab: 'bots' }">
        <div class="flex items-center gap-1 border-b border-surface-border mb-6">
            <button @click="tab = 'bots'" :class="tab === 'bots' ? 'border-primary text-primary font-medium' : 'border-transparent text-content-tertiary hover:text-content-secondary'" :aria-selected="tab === 'bots' ? 'true' : 'false'" role="tab" class="px-4 py-2.5 text-sm transition-colors border-b-2">
                Available Bots
            </button>
            <button @click="tab = 'subscriptions'" :class="tab === 'subscriptions' ? 'border-primary text-primary font-medium' : 'border-transparent text-content-tertiary hover:text-content-secondary'" :aria-selected="tab === 'subscriptions' ? 'true' : 'false'" role="tab" class="px-4 py-2.5 text-sm transition-colors border-b-2">
                My Subscriptions
                            </button>
        </div>

        
        <div x-show="tab === 'bots'">
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                                            <a href="{{ url('') }}/dashboard/bot-trading/bot/1" class="group block bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">ScalpX Pro</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                                                                <span class="bg-warning/10 text-warning text-[10px] font-medium px-1.5 py-0.5 rounded">Scalping</span>
                                        <span class="text-content-tertiary text-[10px]">401 + subscribers</span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-base font-bold text-gain">2.50%</p>
                                    <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-4 gap-3 py-3 border-t border-surface-border">
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">30d</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Max Duration</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-gain">72%</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Win Rate</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">$100.00</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Min Invest</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">5m</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Trade Interval</p>
                                </div>
                            </div>

                            
                            <div class="mt-3 flex items-center justify-center gap-1.5 py-2 rounded-lg bg-primary/10 text-primary text-xs font-semibold group-hover:bg-primary group-hover:text-content-inverse transition-all duration-200">
                                View Bot
                                <svg class="w-3.5 h-3.5 opacity-0 -ml-1 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path></svg>
                            </div>
                        </a>
                                            <a href="{{ url('') }}/dashboard/bot-trading/bot/2" class="group block bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">DayTrader Elite</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                                                                <span class="bg-info/10 text-info text-[10px] font-medium px-1.5 py-0.5 rounded">Day Trading</span>
                                        <span class="text-content-tertiary text-[10px]">400 + subscribers</span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-base font-bold text-gain">3.20%</p>
                                    <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-4 gap-3 py-3 border-t border-surface-border">
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">60d</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Max Duration</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-gain">65%</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Win Rate</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">$250.00</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Min Invest</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">10m</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Trade Interval</p>
                                </div>
                            </div>

                            
                            <div class="mt-3 flex items-center justify-center gap-1.5 py-2 rounded-lg bg-primary/10 text-primary text-xs font-semibold group-hover:bg-primary group-hover:text-content-inverse transition-all duration-200">
                                View Bot
                                <svg class="w-3.5 h-3.5 opacity-0 -ml-1 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path></svg>
                            </div>
                        </a>
                                            <a href="{{ url('') }}/dashboard/bot-trading/bot/3" class="group block bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">SwingMaster</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                                                                <span class="bg-primary/10 text-primary text-[10px] font-medium px-1.5 py-0.5 rounded">Swing Trading</span>
                                        <span class="text-content-tertiary text-[10px]">400 + subscribers</span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-base font-bold text-gain">4.00%</p>
                                    <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-4 gap-3 py-3 border-t border-surface-border">
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">90d</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Max Duration</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-gain">68%</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Win Rate</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">$500.00</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Min Invest</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">15m</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Trade Interval</p>
                                </div>
                            </div>

                            
                            <div class="mt-3 flex items-center justify-center gap-1.5 py-2 rounded-lg bg-primary/10 text-primary text-xs font-semibold group-hover:bg-primary group-hover:text-content-inverse transition-all duration-200">
                                View Bot
                                <svg class="w-3.5 h-3.5 opacity-0 -ml-1 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path></svg>
                            </div>
                        </a>
                                            <a href="{{ url('') }}/dashboard/bot-trading/bot/4" class="group block bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">CryptoSniper</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                                                                <span class="bg-warning/10 text-warning text-[10px] font-medium px-1.5 py-0.5 rounded">Scalping</span>
                                        <span class="text-content-tertiary text-[10px]">400 + subscribers</span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-base font-bold text-gain">5.00%</p>
                                    <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-4 gap-3 py-3 border-t border-surface-border">
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">30d</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Max Duration</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-gain">60%</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Win Rate</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">$200.00</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Min Invest</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">5m</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Trade Interval</p>
                                </div>
                            </div>

                            
                            <div class="mt-3 flex items-center justify-center gap-1.5 py-2 rounded-lg bg-primary/10 text-primary text-xs font-semibold group-hover:bg-primary group-hover:text-content-inverse transition-all duration-200">
                                View Bot
                                <svg class="w-3.5 h-3.5 opacity-0 -ml-1 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path></svg>
                            </div>
                        </a>
                                            <a href="{{ url('') }}/dashboard/bot-trading/bot/5" class="group block bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">Sentinel AI</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                                                                <span class="bg-info/10 text-info text-[10px] font-medium px-1.5 py-0.5 rounded">Day Trading</span>
                                        <span class="text-content-tertiary text-[10px]">400 + subscribers</span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-base font-bold text-gain">3.80%</p>
                                    <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-4 gap-3 py-3 border-t border-surface-border">
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">45d</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Max Duration</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-gain">70%</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Win Rate</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">$500.00</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Min Invest</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">8m</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Trade Interval</p>
                                </div>
                            </div>

                            
                            <div class="mt-3 flex items-center justify-center gap-1.5 py-2 rounded-lg bg-primary/10 text-primary text-xs font-semibold group-hover:bg-primary group-hover:text-content-inverse transition-all duration-200">
                                View Bot
                                <svg class="w-3.5 h-3.5 opacity-0 -ml-1 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path></svg>
                            </div>
                        </a>
                                            <a href="{{ url('') }}/dashboard/bot-trading/bot/6" class="group block bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">Apex Swing</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                                                                <span class="bg-primary/10 text-primary text-[10px] font-medium px-1.5 py-0.5 rounded">Swing Trading</span>
                                        <span class="text-content-tertiary text-[10px]">400 + subscribers</span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-base font-bold text-gain">2.00%</p>
                                    <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-4 gap-3 py-3 border-t border-surface-border">
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">90d</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Max Duration</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-gain">75%</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Win Rate</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">$1,000.00</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Min Invest</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">20m</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Trade Interval</p>
                                </div>
                            </div>

                            
                            <div class="mt-3 flex items-center justify-center gap-1.5 py-2 rounded-lg bg-primary/10 text-primary text-xs font-semibold group-hover:bg-primary group-hover:text-content-inverse transition-all duration-200">
                                View Bot
                                <svg class="w-3.5 h-3.5 opacity-0 -ml-1 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path></svg>
                            </div>
                        </a>
                                            <a href="{{ url('') }}/dashboard/bot-trading/bot/7" class="group block bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">Turbo Scalp</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                                                                <span class="bg-warning/10 text-warning text-[10px] font-medium px-1.5 py-0.5 rounded">Scalping</span>
                                        <span class="text-content-tertiary text-[10px]">400 + subscribers</span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-base font-bold text-gain">1.80%</p>
                                    <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-4 gap-3 py-3 border-t border-surface-border">
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">14d</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Max Duration</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-gain">78%</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Win Rate</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">$50.00</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Min Invest</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">5m</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Trade Interval</p>
                                </div>
                            </div>

                            
                            <div class="mt-3 flex items-center justify-center gap-1.5 py-2 rounded-lg bg-primary/10 text-primary text-xs font-semibold group-hover:bg-primary group-hover:text-content-inverse transition-all duration-200">
                                View Bot
                                <svg class="w-3.5 h-3.5 opacity-0 -ml-1 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path></svg>
                            </div>
                        </a>
                                            <a href="{{ url('') }}/dashboard/bot-trading/bot/8" class="group block bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
                            
                            <div class="flex items-center gap-3.5 mb-4">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border group-hover:ring-primary/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">Horizon Fund</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                                                                <span class="bg-info/10 text-info text-[10px] font-medium px-1.5 py-0.5 rounded">Day Trading</span>
                                        <span class="text-content-tertiary text-[10px]">400 + subscribers</span>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-base font-bold text-gain">2.80%</p>
                                    <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-4 gap-3 py-3 border-t border-surface-border">
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">60d</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Max Duration</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-gain">66%</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Win Rate</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">$300.00</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Min Invest</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-semibold text-content-primary">10m</p>
                                    <p class="text-[10px] text-content-tertiary mt-0.5">Trade Interval</p>
                                </div>
                            </div>

                            
                            <div class="mt-3 flex items-center justify-center gap-1.5 py-2 rounded-lg bg-primary/10 text-primary text-xs font-semibold group-hover:bg-primary group-hover:text-content-inverse transition-all duration-200">
                                View Bot
                                <svg class="w-3.5 h-3.5 opacity-0 -ml-1 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path></svg>
                            </div>
                        </a>
                                    </div>
                <div class="mt-6"></div>
                    </div>

        
        <div x-show="tab === 'subscriptions'" style="display: none;">
                            <div class="bg-surface-raised border border-surface-border rounded-xl p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-content-tertiary mx-auto mb-3" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                    <p class="text-content-secondary mb-2">You haven't subscribed to any bots yet.</p>
                    <button @click="tab = 'bots'" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors">Browse Available Bots →</button>
                </div>
                    </div>
    </div>

        </div>

        
        
    
@endsection

@push('head')
<style>[wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {display:none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {animation-duration: 50000s;animation-name: livewireautofill;}@keyframes livewireautofill { from {} }</style>
@endpush
