@php
    $active = 'nft-gallery';
    $headerTitle = 'NFT Marketplace';
    $activeCat = $filters['category_id'] ?? null;
    function nftImg($image) { return $image && str_starts_with($image, 'http') ? $image : asset('storage/' . $image); }
@endphp

@extends('layouts.dashboard')

@section('pageTitle', 'NFT Marketplace')

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

    
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
        <div>
            <h2 class="text-xl font-bold text-content-primary">NFT Marketplace</h2>
            <p class="text-sm text-content-secondary mt-1">Discover, collect, and trade unique digital assets</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ url('') }}/dashboard/nfts/create" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                Mint NFT
            </a>
            <a href="{{ url('') }}/dashboard/my-nfts" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">My NFTs</a>
        </div>
    </div>

    
    
    
            <div class="mb-6">
            <h3 class="text-sm font-semibold text-content-primary mb-3 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-content-tertiary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"></path>
</svg>
 Collections
            </h3>
            <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-thin">
                                    @foreach($collections as $collection)
                    <a href="{{ url('') }}/dashboard/nfts/collection/{{ $collection->id }}" class="flex-shrink-0 px-4 py-2.5 rounded-xl bg-surface-raised border border-surface-border hover:border-primary/50 transition-colors text-center min-w-[120px]">
                        <p class="text-sm font-medium text-content-primary truncate">{{ $collection->name }}</p>
                        <p class="text-xs text-content-tertiary">{{ $collection->items_count }} item{{ $collection->items_count == 1 ? '' : 's' }}</p>
                    </a>
                                    @endforeach
                            </div>
        </div>
    
    
    <div class="rounded-xl bg-surface-raised border border-surface-border p-4 mb-6" x-data="{ showFilters: false }">
        <form method="GET" action="{{ url('') }}/dashboard/nft-gallery">
            <div class="flex flex-wrap items-center gap-2 mb-3">
                
                <a href="{{ url('') }}/dashboard/nft-gallery" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ !$activeCat ? 'bg-primary text-content-inverse' : 'bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary' }}">All</a>
                                                    <a href="{{ url('') }}/dashboard/nft-gallery?category_id=1" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ $activeCat == 1 ? 'bg-primary text-content-inverse' : 'bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary' }}">Digital Art</a>
                                                    <a href="{{ url('') }}/dashboard/nft-gallery?category_id=2" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ $activeCat == 2 ? 'bg-primary text-content-inverse' : 'bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary' }}">Photography</a>
                                                    <a href="{{ url('') }}/dashboard/nft-gallery?category_id=3" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ $activeCat == 3 ? 'bg-primary text-content-inverse' : 'bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary' }}">Music</a>
                                                    <a href="{{ url('') }}/dashboard/nft-gallery?category_id=4" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ $activeCat == 4 ? 'bg-primary text-content-inverse' : 'bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary' }}">Collectibles</a>
                                                    <a href="{{ url('') }}/dashboard/nft-gallery?category_id=5" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-colors {{ $activeCat == 5 ? 'bg-primary text-content-inverse' : 'bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary' }}">Virtual Worlds</a>
                
                <button type="button" @click="showFilters = !showFilters" class="ml-auto px-3 py-1.5 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-xs font-medium transition-colors inline-flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z"></path>
</svg>
 Filters
                </button>
            </div>

            
            <div class="flex gap-2">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search by name, description, or token ID..." class="flex-1 px-3 py-2.5 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary">
                <button type="submit" class="px-4 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Search</button>
            </div>

            
            <div x-show="showFilters" x-transition="" class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-3 pt-3 border-t border-surface-border" style="display: none;">
                <div>
                    <label class="block text-xs text-content-tertiary mb-1">Min Price (USD)</label>
                    <input type="number" name="min_price" step="0.01" value="{{ $filters['min_price'] ?? '' }}" class="w-full px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="0">
                </div>
                <div>
                    <label class="block text-xs text-content-tertiary mb-1">Max Price (USD)</label>
                    <input type="number" name="max_price" step="0.01" value="{{ $filters['max_price'] ?? '' }}" class="w-full px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary" placeholder="100">
                </div>
                <div>
                    <label class="block text-xs text-content-tertiary mb-1">Collection</label>
                    <select name="collection_id" class="w-full px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">All</option>
                                                    <option value="1">Cosmic Explorers</option>
                                                    <option value="2">Urban Lens</option>
                                                    <option value="3">Beat Drops</option>
                                                    <option value="4">Pixel Legends</option>
                                                    <option value="5">Meta Estates</option>
                                            </select>
                </div>
                <div>
                    <label class="block text-xs text-content-tertiary mb-1">Sort By</label>
                    <select name="sort" class="w-full px-3 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-primary text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="latest">Latest</option>
                        <option value="price_asc">Price: Low → High</option>
                        <option value="price_desc">Price: High → Low</option>
                        <option value="popular">Most Viewed</option>
                        <option value="liked">Most Liked</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @forelse($items as $item)
        <a href="{{ url('') }}/dashboard/nfts/{{ $item->id }}" class="group bg-surface-raised border border-surface-border rounded-xl overflow-hidden hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
            <div class="aspect-square overflow-hidden bg-surface-overlay">
                <img src="{{ nftImg($item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
            </div>
            <div class="p-4">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors">{{ $item->name }}</h3>
                        <p class="text-xs text-content-tertiary truncate">{{ $item->collection?->name ?? 'No collection' }}</p>
                    </div>
                                        </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-content-tertiary uppercase tracking-wider">Price</p>
                        <p class="text-sm font-bold text-content-primary">${{ number_format($item->price, 2) }}</p>
                    </div>
                    <span class="text-xs text-content-tertiary">#{{ $item->id }}</span>
                </div>
            </div>
        </a>
    @empty
        <div class="col-span-full rounded-xl bg-surface-raised border border-surface-border p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-content-tertiary mx-auto mb-3" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
</svg>
                <p class="text-content-secondary mb-1">No NFTs found</p>
                <p class="text-xs text-content-tertiary">Try adjusting your search or filters</p>
            </div>
    @endforelse
            </div>

    
        </div>

        
        
    
@endsection

@push('head')
<style>[wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {display:none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {animation-duration: 50000s;animation-name: livewireautofill;}@keyframes livewireautofill { from {} }</style>
@endpush
