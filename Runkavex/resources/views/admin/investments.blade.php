@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div>
        <h2 class="text-xl font-bold text-content-primary">Investments</h2>
        <p class="text-sm text-content-secondary mt-1">All user investments in trading plans</p>
    </div>

    <form method="GET" action="{{ route('admin.investments') }}" class="flex gap-3">
        <select name="status" onchange="this.form.submit()" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="all" {{ $statusFilter === 'all' ? 'selected' : '' }}>All statuses</option>
            <option value="active" {{ $statusFilter === 'active' ? 'selected' : '' }}>Active</option>
            <option value="pending" {{ $statusFilter === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="rejected" {{ $statusFilter === 'rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="completed" {{ $statusFilter === 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Plan</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Rate</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Start</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">End</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($investments as $investment)
                        <tr>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $investment->user) }}" class="font-medium text-content-primary hover:text-primary">{{ $investment->user->name }}</a>
                            </td>
                            <td class="px-5 py-3 text-content-primary">{{ $investment->plan_name }}</td>
                            <td class="px-5 py-3 font-semibold text-content-primary">${{ number_format($investment->amount, 2) }}</td>
                            <td class="px-5 py-3 text-content-secondary">{{ $investment->interest_rate }}%</td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $investment->start_date }}</td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $investment->end_date }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $investment->status === 'active' ? 'bg-gain/10 text-gain' : ($investment->status === 'completed' ? 'bg-info/10 text-info' : ($investment->status === 'rejected' ? 'bg-loss/10 text-loss' : 'bg-warning/10 text-warning')) }}">{{ $investment->status }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-8 text-center text-content-tertiary">No investments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $investments->links() }}</div>
    </div>
</div>

@endsection