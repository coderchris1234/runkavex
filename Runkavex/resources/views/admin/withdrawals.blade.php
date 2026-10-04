@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ manual: false }">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Withdrawals</h2>
            <p class="text-sm text-content-secondary mt-1">Review and process withdrawal requests</p>
        </div>
        <div class="flex gap-2">
            <button @click="manual = !manual" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">+ Manual Withdrawal</button>
            <a href="{{ route('admin.users') }}" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Users</a>
        </div>
    </div>

    <form x-show="manual" x-cloak method="POST" action="{{ url('/admin/manual/withdrawals') }}" class="bg-surface-raised border border-surface-border rounded-xl p-5 grid md:grid-cols-5 gap-3 items-end">
        @csrf
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-content-secondary mb-1">User</label>
            <select name="user_id" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                <option value="">Select user...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-content-secondary mb-1">Amount ($)</label>
            <input type="number" name="amount" step="0.01" min="0.01" required placeholder="1000" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-content-secondary mb-1">Method</label>
            <input type="text" name="method" placeholder="Manual" value="Manual" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Debit Withdrawal</button>
    </form>

    <form method="GET" action="{{ route('admin.withdrawals') }}" class="flex gap-3">
        <select name="status" onchange="this.form.submit()" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="">All statuses</option>
            <option value="pending" {{ $statusFilter === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ $statusFilter === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ $statusFilter === 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Method</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Address</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($withdrawals as $withdrawal)
                        <tr>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $withdrawal->user) }}" class="font-medium text-content-primary hover:text-primary">{{ $withdrawal->user->name }}</a>
                                <p class="text-xs text-content-tertiary">{{ $withdrawal->user->email }}</p>
                            </td>
                            <td class="px-5 py-3 font-semibold text-content-primary">${{ number_format($withdrawal->amount, 2) }}</td>
                            <td class="px-5 py-3 capitalize text-content-secondary">{{ $withdrawal->method }}</td>
                            <td class="px-5 py-3 text-content-tertiary text-xs break-all max-w-[14rem]">{{ $withdrawal->address }}</td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $withdrawal->created_at->format('M j, Y H:i') }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $withdrawal->status === 'approved' ? 'bg-gain/10 text-gain' : ($withdrawal->status === 'rejected' ? 'bg-loss/10 text-loss' : 'bg-warning/10 text-warning') }}">{{ $withdrawal->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                @if($withdrawal->status === 'pending')
                                    <div class="flex flex-col gap-1.5 w-44">
                                        <form method="POST" action="{{ url('/admin/withdrawals/' . $withdrawal->id . '/approve') }}" class="flex items-center gap-1.5">
                                            @csrf
                                            <input type="text" name="note" placeholder="Note (optional)" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-2 py-1.5 text-xs text-content-primary focus:outline-none focus:border-primary">
                                            <button type="submit" class="shrink-0 px-3 py-1.5 text-xs font-medium rounded-lg bg-gain/10 text-gain hover:bg-gain/20 transition-colors">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ url('/admin/withdrawals/' . $withdrawal->id . '/reject') }}" @submit="confirm('Reject this withdrawal?')" x-data class="flex items-center gap-1.5">
                                            @csrf
                                            <input type="text" name="note" placeholder="Rejection reason" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-2 py-1.5 text-xs text-content-primary focus:outline-none focus:border-primary">
                                            <button type="submit" class="shrink-0 px-3 py-1.5 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-content-tertiary">{{ $withdrawal->note ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-8 text-center text-content-tertiary">No withdrawals found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $withdrawals->links() }}</div>
    </div>
</div>

@endsection