@extends('layouts.dashboard')

@section('pageTitle', 'My Stock Portfolio')

@section('content')

<div class="p-4 lg:p-6 space-y-6">

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ url('') }}/dashboard/stocks" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            Stock Shares
        </a>
        <a href="{{ url('') }}/dashboard/stocks/history" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
            Trade History
        </a>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">My Portfolio</h2>
        <p class="text-sm text-content-secondary mt-1">Your fractional stock positions</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Portfolio Value</p>
            <p class="text-2xl font-bold text-content-primary">${{ number_format($totalValue, 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Total Cost Basis</p>
            <p class="text-2xl font-bold text-content-primary">${{ number_format($totalCost, 2) }}</p>
        </div>
    </div>

    @if(count($rows) > 0)
    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-surface-border bg-surface-overlay/50">
                        <th class="text-left text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Company</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Shares</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Avg Cost</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Market Price</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3">Value</th>
                        <th class="text-right text-xs font-semibold text-content-tertiary uppercase tracking-wider px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                    <tr class="border-b border-surface-border last:border-0 hover:bg-surface-overlay/40 transition-colors">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if($row['logo'])
                                <img src="{{ $row['logo'] }}" alt="{{ $row['symbol'] }}" class="w-10 h-10 rounded-full object-cover bg-surface-overlay flex-shrink-0">
                                @else
                                <div class="w-10 h-10 rounded-full bg-primary/15 text-primary flex items-center justify-center font-semibold text-xs flex-shrink-0">{{ $row['symbol'] }}</div>
                                @endif
                                <div>
                                    <p class="text-sm font-semibold text-content-primary">{{ $row['symbol'] }}</p>
                                    <p class="text-xs text-content-tertiary max-w-[160px] truncate">{{ $row['company'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-right text-sm font-semibold text-content-primary">{{ rtrim(rtrim(number_format($row['shares'], 6, '.', ''), '0'), '.') }}</td>
                        <td class="px-5 py-4 text-right text-sm text-content-secondary">${{ number_format($row['avgCost'], 2) }}</td>
                        <td class="px-5 py-4 text-right text-sm text-content-secondary">${{ number_format($row['current'], 2) }}</td>
                        <td class="px-5 py-4 text-right text-sm font-semibold text-content-primary">${{ number_format($row['value'], 2) }}</td>
                        <td class="px-5 py-4 text-right w-24">
                            @if($row['stockId'])
                            <a href="{{ url('') }}/dashboard/stocks/{{ $row['stockId'] }}" class="inline-flex items-center gap-1 bg-surface-overlay hover:bg-primary hover:text-content-inverse text-content-primary text-xs font-medium px-3 py-1.5 rounded-lg transition-colors">
                                Trade
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="bg-surface-raised border border-surface-border rounded-xl p-8 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-content-tertiary mx-auto mb-3" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
        <p class="text-content-secondary mb-2">You don't hold any stock positions yet.</p>
        <a href="{{ url('') }}/dashboard/stocks" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors">Browse Stocks →</a>
    </div>
    @endif

</div>

@endsection