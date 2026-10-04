@php $active = 'loans/apply'; $headerTitle = 'My Loans'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'My Loans')

@section('content')

<div class="p-4 lg:p-6 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">My Loans</h2>
            <p class="text-sm text-content-secondary mt-1">Manage your loan applications</p>
        </div>
        <a href="{{ url('/dashboard/loans/apply') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary text-content-inverse text-sm font-semibold transition-colors hover:bg-primary-dark">
            Apply for Loan
        </a>
    </div>

    @if(session('success'))
    <div class="p-3 rounded-lg bg-gain/10 border border-gain/20 text-gain text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border text-left">
                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-content-tertiary">Reference</th>
                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-content-tertiary">Plan</th>
                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-content-tertiary">Amount</th>
                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-content-tertiary">Duration</th>
                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-content-tertiary">Monthly</th>
                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-content-tertiary">Total Repayable</th>
                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-content-tertiary">Status</th>
                        <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wider text-content-tertiary">Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                    <tr class="border-b border-surface-border last:border-0 hover:bg-surface-overlay/50 transition-colors">
                        <td class="px-5 py-3.5 text-content-secondary">{{ $loan->reference }}</td>
                        <td class="px-5 py-3.5 text-content-primary font-medium">{{ $loan->plan_name }}</td>
                        <td class="px-5 py-3.5 text-content-secondary">${{ number_format($loan->amount, 2) }}</td>
                        <td class="px-5 py-3.5 text-content-secondary">{{ $loan->duration }} mo</td>
                        <td class="px-5 py-3.5 text-content-secondary">${{ number_format($loan->monthly_payment, 2) }}</td>
                        <td class="px-5 py-3.5 text-content-primary font-medium">${{ number_format($loan->total_repayable, 2) }}</td>
                        <td class="px-5 py-3.5">
                            @if($loan->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning/15 text-warning">Pending</span>
                            @elseif($loan->status === 'approved')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gain/15 text-gain">Approved</span>
                            @elseif($loan->status === 'rejected')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-loss/15 text-loss">Rejected</span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-surface-overlay text-content-secondary">{{ ucfirst($loan->status) }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-content-tertiary">{{ $loan->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-10 text-center text-content-tertiary">
                            You have not applied for any loans yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection