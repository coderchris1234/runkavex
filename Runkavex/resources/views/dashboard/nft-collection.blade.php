@php
    $active = 'nft-gallery';
    $headerTitle = $collection->name;
    function nftImg2($image) { return $image && str_starts_with($image, 'http') ? $image : asset('storage/' . $image); }
@endphp

@extends('layouts.dashboard')

@section('pageTitle', $collection->name . ' — NFT Marketplace')

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
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">{{ $collection->name }}</h2>
        <p class="text-sm text-content-secondary mt-1">{{ $collection->description }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($items as $item)
        <a href="{{ url('') }}/dashboard/nfts/{{ $item->id }}" class="group bg-surface-raised border border-surface-border rounded-xl overflow-hidden hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5 transition-all duration-200">
            <div class="aspect-square overflow-hidden bg-surface-overlay">
                <img src="{{ nftImg2($item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
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
                    <span class="text-xs text-content-secondary">{{ $item->category?->name }}</span>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full rounded-xl bg-surface-raised border border-surface-border p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-content-tertiary mx-auto mb-3" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"></path>
</svg>
            <p class="text-content-secondary mb-1">No NFTs in this collection yet</p>
            <a href="{{ url('') }}/dashboard/nft-gallery" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors">Browse the Marketplace →</a>
        </div>
        @endforelse
    </div>

</div>

@endsection