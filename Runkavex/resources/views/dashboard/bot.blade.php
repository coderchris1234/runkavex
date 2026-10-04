@php
    $active = 'bot-trading';
    $headerTitle = $bot['name'];
    $typeClass = $bot['type'] === 'Scalping'
        ? 'bg-warning/10 text-warning'
        : ($bot['type'] === 'Day Trading' ? 'bg-info/10 text-info' : 'bg-primary/10 text-primary');
@endphp

@extends('layouts.dashboard')

@section('pageTitle', $bot['name'])

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
        <a href="{{ url('') }}/dashboard/bot-trading" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            Bot Trading
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5 sm:p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center ring-2 ring-surface-border flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-primary" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-content-primary">{{ $bot['name'] }}</h1>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="{{ $typeClass }} text-[10px] font-medium px-1.5 py-0.5 rounded">{{ $bot['type'] }}</span>
                            <span class="text-xs text-content-tertiary">{{ $bot['subscribers'] }} subscribers</span>
                            <span class="text-xs text-gain">{{ $bot['win'] }}% win rate</span>
                        </div>
                    </div>
                    <div class="ml-auto text-right flex-shrink-0">
                        <p class="text-2xl font-bold text-gain">{{ number_format($bot['roi'], 2) }}%</p>
                        <p class="text-[10px] text-content-tertiary">Est. daily ROI</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6">
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Est. Daily ROI</p>
                        <p class="text-xl font-bold text-gain">{{ number_format($bot['roi'], 2) }}%</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Max Duration</p>
                        <p class="text-xl font-bold text-content-primary">{{ $bot['max_duration'] }}d</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Min Invest</p>
                        <p class="text-xl font-bold text-content-primary">${{ number_format($bot['min'], 2) }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Max Invest</p>
                        <p class="text-xl font-bold text-content-primary">${{ number_format($bot['max'], 2) }}</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Win Rate</p>
                        <p class="text-xl font-bold text-gain">{{ $bot['win'] }}%</p>
                    </div>
                    <div class="bg-surface-overlay/50 border border-surface-border rounded-lg p-4">
                        <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Trade Interval</p>
                        <p class="text-xl font-bold text-content-primary">{{ $bot['interval'] }}</p>
                    </div>
                </div>

                <div class="mb-2 flex items-center justify-between">
                    <span class="text-xs text-content-tertiary">Win Rate</span>
                    <span class="text-sm font-semibold text-content-primary">{{ $bot['win'] }}%</span>
                </div>
                <div class="w-full h-2 rounded-full bg-surface-overlay overflow-hidden">
                    <div class="h-full rounded-full bg-gain" style="width: {{ $bot['win'] }}%"></div>
                </div>
            </div>

            @if($subscribed)
            <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gain/10 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gain">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-content-primary">{{ $bot['name'] }} is running on your account</p>
                        <p class="text-xs text-content-tertiary mt-0.5">View your bot from the Bot Trading page subscriptions tab.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-base font-bold text-content-primary mb-1">Run {{ $bot['name'] }}</h3>
                <p class="text-xs text-content-tertiary mb-5">Deploy this bot for {{ $bot['max_duration'] }} days and let automated trading work for you.</p>

                <form method="POST" action="{{ url('') }}/dashboard/bot-trading/bot/{{ $botId }}/run" x-data="{ amount: '' }">
                    @csrf
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-content-secondary mb-1.5">Investment Amount (USD)</label>
                        <input type="number" id="amount" name="amount" min="{{ $bot['min'] }}" step="0.01" required
                            x-model="amount"
                            placeholder="0.00"
                            class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <p class="text-xs text-content-tertiary mt-1.5">Min ${{ number_format($bot['min'], 2) }} — Max ${{ number_format($bot['max'], 2) }}</p>
                    </div>

                    <div class="rounded-lg bg-surface-overlay/60 border border-surface-border p-4 mb-5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-content-tertiary uppercase tracking-wider">Estimated Daily Profit</span>
                            <span class="text-lg font-bold text-gain" x-text="'$' + (Number(amount || 0) * {{ $bot['roi'] }} / 100).toFixed(2)">$0.00</span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-content-tertiary uppercase tracking-wider">Est. Plan Return ({{ $bot['max_duration'] }}d)</span>
                            <span class="text-sm font-semibold text-content-primary" x-text="'$' + (Number(amount || 0) * {{ $bot['roi'] }} * {{ $bot['max_duration'] }} / 100).toFixed(2)">$0.00</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold py-2.5 rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"></path>
</svg>
                        Run Bot — {{ $bot['max_duration'] }} Day Plan
                    </button>
                </form>

                <div class="border-t border-dashed border-surface-border my-5"></div>

                <a href="{{ url('') }}/dashboard/bot-trading" class="w-full inline-flex items-center justify-center gap-1.5 bg-surface-overlay hover:bg-surface-border text-content-primary text-sm font-medium py-2.5 rounded-lg border border-surface-border transition-colors">
                    View All Bots
                </a>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-sm font-semibold text-content-primary uppercase tracking-wider mb-3">How it works</h3>
                <ul class="space-y-3 text-sm text-content-secondary">
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        Choose a strategy that matches your goals
                    </li>
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        Fund the bot with your investment amount
                    </li>
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        The bot trades automatically to earn daily returns
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection