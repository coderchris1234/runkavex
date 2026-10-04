@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Transactions</h2>
            <p class="text-sm text-content-secondary mt-1">Every credit and debit across the platform</p>
        </div>
        <div class="flex gap-2 text-sm">
            <div class="bg-gain/10 border border-gain/20 rounded-lg px-4 py-2">
                <span class="text-gain font-semibold">+ ${{ number_format($creditTotal, 2) }}</span>
                <span class="text-xs text-content-tertiary ml-1">credits</span>
            </div>
            <div class="bg-loss/10 border border-loss/20 rounded-lg px-4 py-2">
                <span class="text-loss font-semibold">− ${{ number_format(abs($debitTotal), 2) }}</span>
                <span class="text-xs text-content-tertiary ml-1">debits</span>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.transactions') }}" class="flex flex-wrap gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search title, reference, user..."
            class="w-64 bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
        <select name="user_id" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="">All users</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $selectedUser == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
        <select name="type" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="">All types</option>
            @foreach($types as $type)
                <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Filter</button>
        <a href="{{ route('admin.transactions') }}/export?{{ http_build_query(request()->query()) }}" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Export CSV</a>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Type</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Title</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Reference</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($transactions as $transaction)
                        <tr>
                            <td class="px-5 py-3 text-content-tertiary">{{ $transaction->id }}</td>
                            <td class="px-5 py-3">
                                @if($transaction->user)
                                    <a href="{{ route('admin.users.show', $transaction->user) }}" class="font-medium text-content-primary hover:text-primary">{{ $transaction->user->name }}</a>
                                    <p class="text-xs text-content-tertiary">{{ $transaction->user->email }}</p>
                                @else
                                    <span class="text-content-tertiary">N/A</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize bg-surface-overlay text-content-secondary">{{ $transaction->type }}</span>
                            </td>
                            <td class="px-5 py-3 text-content-secondary">{{ $transaction->title }}</td>
                            <td class="px-5 py-3 font-semibold {{ $transaction->amount >= 0 ? 'text-gain' : 'text-loss' }}">
                                {{ $transaction->amount >= 0 ? '+' : '' }}${{ number_format(abs($transaction->amount), 2) }}
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $transaction->status === 'completed' ? 'bg-gain/10 text-gain' : ($transaction->status === 'failed' ? 'bg-loss/10 text-loss' : 'bg-warning/10 text-warning') }}">{{ $transaction->status }}</span>
                            </td>
                            <td class="px-5 py-3 text-content-tertiary text-xs">{{ $transaction->reference }}</td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $transaction->created_at->format('M j, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-5 py-8 text-center text-content-tertiary">No transactions found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $transactions->links() }}</div>
    </div>
</div>

@endsection