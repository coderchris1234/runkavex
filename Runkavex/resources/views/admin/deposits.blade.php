@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ manual: false, proofUrl: null, viewProof(url) { this.proofUrl = url; } }" @keydown.escape.window="proofUrl = null">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Deposits</h2>
            <p class="text-sm text-content-secondary mt-1">Review and approve deposit requests</p>
        </div>
        <div class="flex gap-2">
            <button @click="manual = !manual" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">+ Manual Deposit</button>
            <a href="{{ route('admin.users') }}" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Users</a>
        </div>
    </div>

    <form x-show="manual" x-cloak method="POST" action="{{ url('/admin/manual/deposits') }}" class="bg-surface-raised border border-surface-border rounded-xl p-5 grid md:grid-cols-5 gap-3 items-end">
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
            <input type="number" name="amount" step="0.01" min="0.01" required placeholder="5000" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-content-secondary mb-1">Method</label>
            <input type="text" name="method" placeholder="Manual" value="Manual" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Credit Deposit</button>
    </form>

    <form method="GET" action="{{ route('admin.deposits') }}" class="flex gap-3">
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
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Reference</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Proof</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($deposits as $deposit)
                        <tr>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $deposit->user) }}" class="font-medium text-content-primary hover:text-primary">{{ $deposit->user->name }}</a>
                                <p class="text-xs text-content-tertiary">{{ $deposit->user->email }}</p>
                            </td>
                            <td class="px-5 py-3 font-semibold text-content-primary">${{ number_format($deposit->amount, 2) }}</td>
                            <td class="px-5 py-3">
                                <span class="capitalize text-content-secondary">{{ $deposit->method }}</span>
                                @if($deposit->network)
                                    <span class="block text-xs text-content-tertiary capitalize">{{ str_replace('_', ' ', $deposit->network) }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-content-tertiary text-xs">
                                @if($deposit->tx_hash)
                                    @if($deposit->explorerUrl())
                                        <a href="{{ $deposit->explorerUrl() }}" target="_blank" rel="noopener noreferrer" class="font-mono hover:text-primary break-all">{{ $deposit->tx_hash }}</a>
                                    @else
                                        <span class="font-mono break-all">{{ $deposit->tx_hash }}</span>
                                    @endif
                                @else
                                    —
                                @endif
                                @if($deposit->sender_address)
                                    <p class="font-mono text-[11px] mt-1 break-all">from {{ $deposit->sender_address }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @if($deposit->proof && $deposit->proofUrl())
                                    <button type="button" @click="viewProof('{{ $deposit->proofUrl() }}')"
                                        class="flex items-center gap-2 text-xs text-primary hover:text-primary-dark transition-colors">
                                        <img src="{{ $deposit->proofUrl() }}" alt="Proof of payment for deposit #{{ $deposit->id }}" class="w-10 h-10 object-cover rounded border border-surface-border">
                                        <span>View</span>
                                    </button>
                                @else
                                    <span class="text-xs text-content-tertiary">Not provided</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $deposit->created_at->format('M j, Y H:i') }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $deposit->status === 'approved' ? 'bg-gain/10 text-gain' : ($deposit->status === 'rejected' ? 'bg-loss/10 text-loss' : 'bg-warning/10 text-warning') }}">{{ $deposit->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                @if($deposit->status === 'pending')
                                    <div class="flex flex-col gap-1.5 w-44">
                                        <form method="POST" action="{{ url('/admin/deposits/' . $deposit->id . '/approve') }}" class="flex items-center gap-1.5">
                                            @csrf
                                            <input type="text" name="note" placeholder="Note (optional)" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-2 py-1.5 text-xs text-content-primary focus:outline-none focus:border-primary">
                                            <button type="submit" class="shrink-0 px-3 py-1.5 text-xs font-medium rounded-lg bg-gain/10 text-gain hover:bg-gain/20 transition-colors">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ url('/admin/deposits/' . $deposit->id . '/reject') }}" @submit="confirm('Reject this deposit?')" x-data class="flex items-center gap-1.5">
                                            @csrf
                                            <input type="text" name="note" placeholder="Rejection reason" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-2 py-1.5 text-xs text-content-primary focus:outline-none focus:border-primary">
                                            <button type="submit" class="shrink-0 px-3 py-1.5 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-content-tertiary">{{ $deposit->note ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-5 py-8 text-center text-content-tertiary">No deposits found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $deposits->links() }}</div>
    </div>

    <div x-show="proofUrl" x-cloak style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" @click.self="proofUrl = null">
        <div class="relative max-w-full max-h-full flex flex-col">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-sm font-semibold text-content-inverse">Proof of payment</h3>
                <button type="button" @click="proofUrl = null" class="text-content-inverse/70 hover:text-content-inverse" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <img :src="proofUrl" alt="Proof of payment" class="max-h-[75vh] max-w-full object-contain rounded-lg bg-white p-1">
            <a :href="proofUrl" target="_blank" rel="noopener noreferrer" class="mt-3 text-xs text-content-inverse/80 hover:text-content-inverse text-center underline">Open full size</a>
        </div>
    </div>
</div>

@endsection