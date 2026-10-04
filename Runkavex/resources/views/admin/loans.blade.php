@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div>
        <h2 class="text-xl font-bold text-content-primary">Loans</h2>
        <p class="text-sm text-content-secondary mt-1">Review loan applications, approve or reject</p>
    </div>

    <form method="GET" action="{{ route('admin.loans') }}" class="flex gap-3">
        <select name="status" onchange="this.form.submit()" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="all" {{ $statusFilter === 'all' ? 'selected' : '' }}>All statuses</option>
            <option value="pending" {{ $statusFilter === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="active" {{ $statusFilter === 'active' ? 'selected' : '' }}>Active</option>
            <option value="rejected" {{ $statusFilter === 'rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="repaid" {{ $statusFilter === 'repaid' ? 'selected' : '' }}>Repaid</option>
        </select>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Reference</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Plan</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Repayable</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Duration</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Purpose</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($loans as $loan)
                        <tr>
                            <td class="px-5 py-3 text-content-tertiary text-xs">{{ $loan->reference }}</td>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $loan->user) }}" class="font-medium text-content-primary hover:text-primary">{{ $loan->user->name }}</a>
                            </td>
                            <td class="px-5 py-3 text-content-primary">{{ $loan->plan_name }}</td>
                            <td class="px-5 py-3 font-semibold text-content-primary">${{ number_format($loan->amount, 2) }}</td>
                            <td class="px-5 py-3 text-content-secondary">${{ number_format($loan->total_repayable, 2) }}</td>
                            <td class="px-5 py-3 text-content-secondary">{{ $loan->duration }} mo</td>
                            <td class="px-5 py-3 text-content-tertiary text-xs max-w-[12rem] truncate">{{ $loan->purpose }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $loan->status === 'active' ? 'bg-gain/10 text-gain' : ($loan->status === 'rejected' ? 'bg-loss/10 text-loss' : ($loan->status === 'repaid' ? 'bg-info/10 text-info' : 'bg-warning/10 text-warning')) }}">{{ $loan->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                @if($loan->status === 'pending')
                                    <div class="flex gap-1.5">
                                        <form method="POST" action="{{ url('/admin/loans/' . $loan->id . '/approve') }}">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-gain/10 text-gain hover:bg-gain/20 transition-colors">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ url('/admin/loans/' . $loan->id . '/reject') }}" @submit="confirm('Reject this loan?')" x-data>
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Reject</button>
                                        </form>
                                    </div>
                                @elseif($loan->status === 'active')
                                    <form method="POST" action="{{ url('/admin/loans/' . $loan->id . '/repay') }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-info/10 text-info hover:bg-info/20 transition-colors">Mark Repaid</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="px-5 py-8 text-center text-content-tertiary">No loans found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $loans->links() }}</div>
    </div>
</div>

@endsection