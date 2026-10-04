@extends('layouts.dashboard')

@section('pageTitle', 'My NFTs')

@section('content')

        <div class="p-4 lg:p-6 space-y-6">

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ url('') }}/dashboard/nft-gallery" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            NFT Marketplace
        </a>
        <a href="{{ url('') }}/dashboard/nfts/create" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-primary text-content-inverse hover:bg-primary-dark">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
            Mint NFT
        </a>
    </div>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
        <div>
            <h2 class="text-xl font-bold text-content-primary">My NFTs</h2>
            <p class="text-sm text-content-secondary mt-1">Manage your digital collection</p>
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 transition-colors group min-w-0 overflow-hidden">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2.5 rounded-lg bg-primary-subtle">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path>
</svg>
                </div>
            </div>
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Owned</p>
            <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate">{{ $ownedCount }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 transition-colors group min-w-0 overflow-hidden">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2.5 rounded-lg bg-primary-subtle">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"></path>
</svg>
                </div>
            </div>
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Created</p>
            <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate">{{ $createdCount }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 transition-colors group min-w-0 overflow-hidden">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2.5 rounded-lg bg-primary-subtle">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path>
</svg>
                </div>
            </div>
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Favorites</p>
            <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate">{{ $favoritesCount }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4 sm:p-5 transition-colors group min-w-0 overflow-hidden">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2.5 rounded-lg bg-primary-subtle">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"></path>
</svg>
                </div>
            </div>
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-1">Total Value</p>
            <p class="text-[15px] sm:text-2xl font-bold text-content-primary truncate">${{ number_format($totalValue, 2) }}</p>
        </div>
    </div>

    <div class="flex items-center gap-1 border-b border-surface-border mb-6">
        <a href="{{ url('') }}/dashboard/my-nfts?tab=owned" class="px-4 py-2.5 text-sm font-medium transition-colors border-b-2 {{ $tab === 'owned' ? 'border-primary text-primary' : 'border-transparent text-content-tertiary hover:text-content-primary' }}">
            Owned ({{ $ownedCount }})
        </a>
        <a href="{{ url('') }}/dashboard/my-nfts?tab=created" class="px-4 py-2.5 text-sm font-medium transition-colors border-b-2 {{ $tab === 'created' ? 'border-primary text-primary' : 'border-transparent text-content-tertiary hover:text-content-primary' }}">
            Created ({{ $createdCount }})
        </a>
        <a href="{{ url('') }}/dashboard/my-nfts?tab=favorites" class="px-4 py-2.5 text-sm font-medium transition-colors border-b-2 {{ $tab === 'favorites' ? 'border-primary text-primary' : 'border-transparent text-content-tertiary hover:text-content-primary' }}">
            Favorites ({{ $favoritesCount }})
        </a>
    </div>

    @if($items->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($items as $item)
        <a href="{{ url('') }}/dashboard/nfts/{{ $item->id }}" class="group bg-surface-raised border border-surface-border rounded-xl overflow-hidden hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
            <div class="aspect-square overflow-hidden bg-surface-overlay">
                <img src="{{ $item->image && str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
            </div>
            <div class="p-4">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <h3 class="text-sm font-semibold text-content-primary truncate group-hover:text-primary transition-colors min-w-0">{{ $item->name }}</h3>
                    <span class="text-xs text-content-tertiary flex-shrink-0">#{{ $item->id }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] text-content-tertiary uppercase tracking-wider">Price</p>
                        <p class="text-sm font-bold text-content-primary">${{ number_format($item->price, 2) }}</p>
                    </div>
                    @if(in_array($item->id, $createdIds) && !in_array($item->id, $ownedIds))
                    <span class="text-xs font-medium text-primary">Created by you</span>
                    @elseif(in_array($item->id, $ownedIds) && in_array($item->id, $createdIds))
                    <span class="text-xs font-medium text-primary">Created by you</span>
                    @else
                    <span class="text-xs text-content-tertiary">{{ $item->status === 'listed' ? 'Listed' : 'Sold' }}</span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="rounded-xl bg-surface-raised border border-surface-border p-12 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-content-tertiary mx-auto mb-3" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
</svg>
        @if($tab === 'favorites')
        <p class="text-content-secondary mb-1">No favorite NFTs yet</p>
        <p class="text-xs text-content-tertiary mb-3">Favorites coming soon</p>
        @else
        <p class="text-content-secondary mb-1">No NFTs in your collection</p>
        <p class="text-xs text-content-tertiary mb-3">Browse the marketplace to find your first NFT</p>
        @endif
        <a href="{{ url('') }}/dashboard/nft-gallery" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">
            Browse Gallery
        </a>
    </div>
    @endif

        </div>

@endsection