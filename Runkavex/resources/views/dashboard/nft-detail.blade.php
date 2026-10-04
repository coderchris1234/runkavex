@php
    $active = 'nft-gallery';
    $headerTitle = $item->name;
    $owned = auth()->user()->id === $item->owner_id;
    function nftImg3($image) { return $image && str_starts_with($image, 'http') ? $image : asset('storage/' . $image); }
@endphp

@extends('layouts.dashboard')

@section('pageTitle', $item->name)

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
        <a href="{{ url('') }}/dashboard/nft-gallery" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            NFT Marketplace
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
                <div class="aspect-square bg-surface-overlay">
                    <img src="{{ nftImg3($item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-5 sm:p-6">
                <h2 class="text-base font-bold text-content-primary mb-2">Description</h2>
                <p class="text-sm text-content-secondary leading-relaxed">{{ $item->description ?? 'No description provided.' }}</p>

                @if($item->properties)
                <h3 class="text-sm font-semibold text-content-primary mt-5 mb-2">Properties</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($item->properties as $trait => $value)
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg px-3 py-2">
                        <p class="text-[10px] text-content-tertiary uppercase tracking-wider">{{ $trait }}</p>
                        <p class="text-xs font-semibold text-content-primary">{{ $value }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="min-w-0">
                        <h1 class="text-xl font-semibold text-content-primary truncate">{{ $item->name }}</h1>
                        <p class="text-xs text-content-tertiary mt-0.5">
                            {{ $item->collection?->name ?? 'No collection' }} · {{ $item->category?->name ?? 'Uncategorized' }}
                        </p>
                    </div>
                    <span class="text-xs text-content-tertiary flex-shrink-0">#{{ $item->id }}</span>
                </div>

                <div class="flex items-center justify-between mb-5 bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                    <div>
                        <p class="text-[10px] text-content-tertiary uppercase tracking-wider">Price</p>
                        <p class="text-2xl font-bold text-content-primary">${{ number_format($item->price, 2) }}</p>
                    </div>
                </div>

                @if($owned)
                <div class="w-full inline-flex items-center justify-center gap-2 bg-gain/10 text-gain text-sm font-semibold py-2.5 rounded-lg border border-gain/30">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                    You Own This NFT
                </div>
                @elseif($item->status === 'listed')
                <form method="POST" action="{{ url('') }}/dashboard/nfts/{{ $item->id }}/buy" class="grid grid-cols-3 gap-2">
                    @csrf
                    <button type="submit" class="col-span-2 inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold py-2.5 rounded-lg transition-colors">
                        Buy Now
                    </button>
                    <a href="{{ url('') }}/dashboard/nft-gallery" class="inline-flex items-center justify-center bg-surface-overlay hover:bg-surface-border text-content-primary text-sm font-medium py-2.5 rounded-lg border border-surface-border transition-colors">Back</a>
                </form>
                @else
                <div class="w-full inline-flex items-center justify-center gap-2 bg-surface-overlay text-content-tertiary text-sm font-semibold py-2.5 rounded-lg border border-surface-border">
                    Not Available
                </div>
                @endif

                <div class="border-t border-dashed border-surface-border my-5"></div>

                <div class="flex items-center justify-between text-sm">
                    <span class="text-xs text-content-tertiary uppercase tracking-wider">Owner</span>
                    <span class="font-semibold text-content-primary">{{ $item->owner?->name ?? 'Unknown' }}</span>
                </div>
                <div class="flex items-center justify-between mt-3 text-sm">
                    <span class="text-xs text-content-tertiary uppercase tracking-wider">Views</span>
                    <span class="font-semibold text-content-primary">{{ number_format($item->views) }}</span>
                </div>
                <div class="flex items-center justify-between mt-3 text-sm">
                    <span class="text-xs text-content-tertiary uppercase tracking-wider">Likes</span>
                    <span class="font-semibold text-content-primary">{{ number_format($item->likes) }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection