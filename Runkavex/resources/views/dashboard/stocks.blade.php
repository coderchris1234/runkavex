@php $active = 'stocks'; $headerTitle = 'Stock Shares'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Stock Shares')

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
    <h2 class="text-xl font-bold text-content-primary">Stock Shares</h2>
            <p class="text-sm text-content-secondary mt-1">Buy and sell fractional shares of real stocks</p>
    </div>

    
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ url('') }}/dashboard/stocks/portfolio" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
 My Portfolio
        </a>
        <a href="{{ url('') }}/dashboard/stocks/history" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium bg-surface-overlay text-content-secondary hover:text-content-primary hover:bg-surface-overlay/80 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
 Trade History
        </a>
    </div>

    
    <div x-data="{ search: '' }" class="space-y-6">
        <div class="relative">
            <input type="text" x-model="search" placeholder="Search stocks by name or symbol..." class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 pl-10 text-sm text-content-primary focus:outline-none focus:ring-2 focus:ring-primary">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-content-tertiary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path></svg>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                            <div x-show="!search || 'googl alphabet inc.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/GOOG.png" alt="GOOGL" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">GOOGL</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Alphabet Inc.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$308.70</span>
                                                            <span class="text-xs font-medium ml-1 text-gain">
                                    +0.54%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/30" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'amzn amazon.com, inc.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AMZN.png" alt="AMZN" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">AMZN</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Amazon.com, Inc.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$212.65</span>
                                                            <span class="text-xs font-medium ml-1 text-loss">
                                    -0.78%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/31" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'aapl apple inc.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AAPL.png" alt="AAPL" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">AAPL</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Apple Inc.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$260.81</span>
                                                            <span class="text-xs font-medium ml-1 text-loss">
                                    -0.01%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/28" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'ba boeing company'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <div class="w-10 h-10 rounded-full object-cover bg-surface-overlay bg-primary/15 text-primary flex items-center justify-center font-semibold text-sm">BA</div>>
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">BA</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Boeing Company</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$188.92</span>
                                                            <span class="text-xs font-medium ml-1 text-loss">
                                    -0.89%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/40" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'intc intel corporation'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/INTC.png" alt="INTC" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">INTC</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Intel Corporation</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$42.31</span>
                                                            <span class="text-xs font-medium ml-1 text-loss">
                                    -0.56%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/37" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'jpm jpmorgan chase &amp; co.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <div class="w-10 h-10 rounded-full object-cover bg-surface-overlay bg-primary/15 text-primary flex items-center justify-center font-semibold text-sm">JPM</div>>
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">JPM</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">JPMorgan Chase &amp; Co.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$198.37</span>
                                                            <span class="text-xs font-medium ml-1 text-gain">
                                    +0.64%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/41" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'meta meta platforms inc.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/FB.png" alt="META" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">META</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Meta Platforms Inc.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$502.18</span>
                                                            <span class="text-xs font-medium ml-1 text-gain">
                                    +1.58%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/34" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'msft microsoft corp.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/MSFT.png" alt="MSFT" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">MSFT</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Microsoft Corp.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$404.88</span>
                                                            <span class="text-xs font-medium ml-1 text-loss">
                                    -0.22%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/29" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'nflx netflix inc.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/NFLX.png" alt="NFLX" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">NFLX</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Netflix Inc.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$628.73</span>
                                                            <span class="text-xs font-medium ml-1 text-gain">
                                    +0.45%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/35" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'nvda nvidia corporation'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/NVDA.png" alt="NVDA" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">NVDA</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">NVIDIA Corporation</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$878.35</span>
                                                            <span class="text-xs font-medium ml-1 text-gain">
                                    +3.42%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/33" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'pypl paypal holdings'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <div class="w-10 h-10 rounded-full object-cover bg-surface-overlay bg-primary/15 text-primary flex items-center justify-center font-semibold text-sm">PYPL</div>>
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">PYPL</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">PayPal Holdings</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$63.28</span>
                                                            <span class="text-xs font-medium ml-1 text-gain">
                                    +0.72%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/38" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'tsla tesla inc.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <img src="https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/TSLA.png" alt="TSLA" class="w-10 h-10 rounded-full object-cover bg-surface-overlay">
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">TSLA</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Tesla Inc.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$175.34</span>
                                                            <span class="text-xs font-medium ml-1 text-loss">
                                    -2.15%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/32" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                            <div x-show="!search || 'dis walt disney co.'.includes(search.toLowerCase())" class="bg-surface-raised border border-surface-border rounded-xl p-5 hover:border-primary/30 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                                                            <div class="w-10 h-10 rounded-full object-cover bg-surface-overlay bg-primary/15 text-primary flex items-center justify-center font-semibold text-sm">DIS</div>>
                                                        <div>
                                <h3 class="text-sm font-semibold text-content-primary">DIS</h3>
                                <p class="text-xs text-content-tertiary truncate max-w-[120px]">Walt Disney Co.</p>
                            </div>
                        </div>
                                            </div>

                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <span class="text-lg font-bold text-content-primary">$112.45</span>
                                                            <span class="text-xs font-medium ml-1 text-gain">
                                    +0.31%
                                </span>
                                                    </div>
                    </div>

                    
                    <a href="{{ url('') }}/dashboard/stocks/39" class="block w-full text-center bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2 text-sm font-medium transition-colors">
                        Trade
                    </a>
                </div>
                    </div>
    </div>

        </div>

        
        
    
@endsection

@push('head')
<style>[wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {display:none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {animation-duration: 50000s;animation-name: livewireautofill;}@keyframes livewireautofill { from {} }</style>
@endpush
