@php $active = 'myplans'; $headerTitle = 'My Plans'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'My Plans')

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
        <a href="{{ url('') }}/dashboard/buy-plan" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            Investment Plans
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
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">My Plans</h2>
        <p class="text-sm text-content-secondary mt-1">{{ $all->count() }} investment{{ $all->count() === 1 ? '' : 's' }} found</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Active Investments</p>
            <p class="text-2xl font-bold text-primary">{{ $activePlans->count() }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Completed</p>
            <p class="text-2xl font-bold text-content-primary">{{ $completedPlans->count() }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Total Invested</p>
            <p class="text-2xl font-bold text-content-primary">${{ number_format($all->sum('amount'), 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <p class="text-xs text-content-tertiary uppercase tracking-wider mb-1">Projected Return</p>
            <p class="text-2xl font-bold text-gain">${{ number_format($activePlans->sum('expected_return'), 2) }}</p>
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-2 mb-4">
        <a href="{{ url('') }}/dashboard/myplans/All" class="inline-flex items-center px-4 py-2 text-xs font-semibold rounded-lg transition-colors {{ strtolower($status) === 'all' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary' }}">
            All ({{ $all->count() }})
        </a>
        <a href="{{ url('') }}/dashboard/myplans/Active" class="inline-flex items-center px-4 py-2 text-xs font-semibold rounded-lg transition-colors {{ strtolower($status) === 'active' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary' }}">
            Active ({{ $activePlans->count() }})
        </a>
        <a href="{{ url('') }}/dashboard/myplans/Completed" class="inline-flex items-center px-4 py-2 text-xs font-semibold rounded-lg transition-colors {{ strtolower($status) === 'completed' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:text-content-primary' }}">
            Completed ({{ $completedPlans->count() }})
        </a>
    </div>

    @if($filtered->isEmpty())
        <div class="bg-surface-raised border border-surface-border rounded-xl p-10 text-center">
            <p class="text-sm text-content-secondary mb-4">You haven't purchased any investment plans yet.</p>
            <a href="{{ url('') }}/dashboard/buy-plan" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors">
                Browse Plans
            </a>
        </div>
    @else
        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-content-tertiary uppercase tracking-wider border-b border-surface-border">
                            <th class="px-5 py-3 font-semibold">Plan</th>
                            <th class="px-5 py-3 font-semibold">Amount</th>
                            <th class="px-5 py-3 font-semibold">Rate</th>
                            <th class="px-5 py-3 font-semibold">Duration</th>
                            <th class="px-5 py-3 font-semibold">Start Date</th>
                            <th class="px-5 py-3 font-semibold">End Date</th>
                            <th class="px-5 py-3 font-semibold">Expected Return</th>
                            <th class="px-5 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-border">
                        @foreach($filtered as $inv)
                        <tr class="hover:bg-surface-overlay/50 transition-colors">
                            <td class="px-5 py-4 font-medium text-content-primary">{{ $inv->plan_name }}</td>
                            <td class="px-5 py-4 text-content-primary">${{ number_format($inv->amount, 2) }}</td>
                            <td class="px-5 py-4 text-content-primary">{{ rtrim(rtrim(number_format($inv->interest_rate, 2), '0'), '.') }}%</td>
                            <td class="px-5 py-4 text-content-secondary">{{ $inv->duration_days }} days</td>
                            <td class="px-5 py-4 text-content-secondary">{{ $inv->start_date->format('M d, Y') }}</td>
                            <td class="px-5 py-4 text-content-secondary">{{ $inv->end_date->format('M d, Y') }}</td>
                            <td class="px-5 py-4 text-gain font-medium">${{ number_format($inv->expected_return, 2) }}</td>
                            <td class="px-5 py-4">
                                @if($inv->display_status === 'active')
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-[11px] font-semibold rounded-full bg-gain/10 text-gain">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gain"></span>
                                    Active
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-[11px] font-semibold rounded-full bg-content-tertiary/10 text-content-secondary">
                                    Completed
                                </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
        </div>

@endsection