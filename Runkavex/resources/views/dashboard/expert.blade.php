@php $active = 'copy-trading'; $headerTitle = $expert['name']; @endphp

@extends('layouts.dashboard')

@section('pageTitle', $expert['name'])

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
        <a href="{{ url('') }}/dashboard/copy-trading" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            Copy Trading
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5 sm:p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="relative flex-shrink-0">
                        <img src="{{ asset('storage/' . $expert['image']) }}" alt="{{ $expert['name'] }}" class="w-16 h-16 rounded-full object-cover ring-2 ring-surface-border">
                        <span class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-gain rounded-full border-2 border-surface-raised" title="Active"></span>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-content-primary">{{ $expert['name'] }}</h1>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="bg-primary/10 text-primary text-[10px] font-medium px-1.5 py-0.5 rounded">{{ $expert['type'] }}</span>
                            <span class="text-xs text-content-tertiary">{{ number_format($expert['followers']) }} followers</span>
                            <span class="text-xs text-gain">{{ $expert['win'] }}% win rate</span>
                        </div>
                    </div>
                    <div class="ml-auto text-right flex-shrink-0">
                        <p class="text-2xl font-bold text-gain">{{ number_format($expert['roi'], 2) }}%</p>
                        <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6">
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Est. Daily ROI</p>
                        <p class="text-xl font-bold text-gain">{{ number_format($expert['roi'], 2) }}%</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Duration</p>
                        <p class="text-xl font-bold text-content-primary">{{ $expert['duration'] }}d</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Min Capital</p>
                        <p class="text-xl font-bold text-content-primary">${{ number_format($expert['min'], 2) }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Max Capital</p>
                        <p class="text-xl font-bold text-content-primary">${{ number_format($expert['max'], 2) }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Followers</p>
                        <p class="text-xl font-bold text-content-primary">{{ number_format($expert['followers']) }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Last Trade</p>
                        <p class="text-xl font-bold text-gain">{{ $expert['last_trade'] }}</p>
                    </div>
                </div>

                <div class="mb-2 flex items-center justify-between">
                    <span class="text-xs text-content-tertiary">Win Rate</span>
                    <span class="text-sm font-semibold text-content-primary">{{ $expert['win'] }}%</span>
                </div>
                <div class="w-full h-2 rounded-full bg-surface-overlay overflow-hidden">
                    <div class="h-full rounded-full bg-gain" style="width: {{ $expert['win'] }}%"></div>
                </div>
            </div>

            @if($copying)
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gain/10 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gain">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-content-primary">You are currently copying {{ $expert['name'] }}</p>
                        <p class="text-xs text-content-tertiary mt-0.5">View your position from the Copy Trading page.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-base font-bold text-content-primary mb-1">Start Copying {{ $expert['name'] }}</h3>
                <p class="text-xs text-content-tertiary mb-5">Your funds are invested with this expert for {{ $expert['duration'] }} days.</p>

                <form method="POST" action="{{ url('') }}/dashboard/copy-trading/expert/{{ $expertId }}/copy" x-data="{ amount: '' }">
                    @csrf
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-content-secondary mb-1.5">Investment Amount (USD)</label>
                        <input type="number" id="amount" name="amount" min="{{ $expert['min'] }}" step="0.01" required
                            x-model="amount"
                            placeholder="0.00"
                            class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <p class="text-xs text-content-tertiary mt-1.5">Min ${{ number_format($expert['min'], 2) }} — Max ${{ number_format($expert['max'], 2) }}</p>
                    </div>

                    <div class="rounded-lg bg-surface-overlay/60 border border-surface-border p-4 mb-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-content-tertiary uppercase tracking-wider">Estimated Daily Profit</span>
                            <span class="text-lg font-bold text-gain" x-text="'$' + (Number(amount || 0) * {{ $expert['roi'] }} / 100).toFixed(2)">$0.00</span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-content-tertiary uppercase tracking-wider">Est. Plan Return ({{ $expert['duration'] }}d)</span>
                            <span class="text-sm font-semibold text-content-primary" x-text="'$' + (Number(amount || 0) * {{ $expert['roi'] }} * {{ $expert['duration'] }} / 100).toFixed(2)">$0.00</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold py-2.5 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"></path>
</svg>
                        Start Copying — {{ $expert['duration'] }} Day Plan
                    </button>
                </form>

                <div class="border-t border-dashed border-surface-border my-5"></div>

                <a href="{{ url('') }}/dashboard/copy-trading" class="w-full inline-flex items-center justify-center gap-1.5 bg-surface-overlay hover:bg-surface-border text-content-primary text-sm font-medium py-2.5 rounded-lg border border-surface-border transition-colors">
                    View All Experts
                </a>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-sm font-semibold text-content-primary uppercase tracking-wider mb-3">How copy trading works</h3>
                <ul class="space-y-3 text-sm text-content-secondary">
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        Choose an expert based on performance
                    </li>
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        Allocate an investment amount
                    </li>
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        Earn estimated daily returns automatically
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection