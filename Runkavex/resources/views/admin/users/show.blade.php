@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <a href="{{ route('admin.users') }}" class="text-xs text-content-tertiary hover:text-content-primary mb-1 inline-block">&larr; Back to users</a>
            <h2 class="text-xl font-bold text-content-primary">{{ $user->name }}</h2>
            <p class="text-sm text-content-secondary">{{ $user->email }} · {{ $user->username ?? 'No username' }}</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <span class="px-2 py-1 text-xs font-medium rounded {{ $user->is_admin ? 'bg-primary/10 text-primary' : 'bg-surface-overlay text-content-tertiary' }}">{{ $user->is_admin ? 'Admin' : 'User' }}</span>
            <span class="px-2 py-1 text-xs font-medium rounded {{ $user->is_active ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ $user->is_active ? 'Active' : 'Deactivated' }}</span>
            <span class="px-2 py-1 text-xs font-medium rounded bg-surface-overlay text-content-tertiary">{{ $user->country ?? '—' }}</span>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Balance</p>
            <p class="text-xl font-bold text-content-primary mt-1">${{ number_format($user->balance, 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Total Profit</p>
            <p class="text-xl font-bold {{ $user->total_profit >= 0 ? 'text-gain' : 'text-loss' }} mt-1">${{ number_format($user->total_profit, 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Deposits</p>
            <p class="text-xl font-bold text-content-primary mt-1">{{ $user->deposits->count() }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Withdrawals</p>
            <p class="text-xl font-bold text-content-primary mt-1">{{ $user->withdrawals->count() }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Open Trades</p>
            <p class="text-xl font-bold text-content-primary mt-1">{{ $user->trades->whereIn('status', ['open', 'processing'])->count() }}</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <form method="POST" action="{{ url('/admin/users/' . $user->id . '/balance') }}" class="space-y-4">
                @csrf
                <div>
                    <h3 class="text-sm font-semibold text-content-primary mb-1">Adjust Balance</h3>
                    <p class="text-xs text-content-tertiary">Credit or debit this user's account. A transaction record is logged.</p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <select name="type" class="bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        <option value="credit">Credit (+)</option>
                        <option value="debit">Debit (−)</option>
                    </select>
                    <input type="number" name="amount" step="0.01" min="0.01" placeholder="Amount" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                </div>
                <input type="text" name="note" placeholder="Note (optional)" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Apply Adjustment</button>
            </form>
        </div>

        <div class="bg-surface-raised border border-surface-border rounded-xl p-5 space-y-3">
            <h3 class="text-sm font-semibold text-content-primary">Account Controls</h3>
            <form method="POST" action="{{ url('/admin/users/' . $user->id . '/toggle-active') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 rounded-lg border text-sm font-medium transition-colors {{ $user->is_active ? 'border-loss/40 text-loss hover:bg-loss/10' : 'border-gain/40 text-gain hover:bg-gain/10' }}">
                    {{ $user->is_active ? 'Deactivate Account' : 'Reactivate Account' }}
                </button>
            </form>
            <form method="POST" action="{{ url('/admin/users/' . $user->id . '/toggle-admin') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 rounded-lg border border-surface-border text-sm font-medium text-content-secondary hover:text-content-primary hover:bg-surface-overlay transition-colors">
                    {{ $user->is_admin ? 'Revoke Admin Access' : 'Grant Admin Access' }}
                </button>
            </form>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <form method="POST" action="{{ url('/admin/users/' . $user->id) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <h3 class="text-sm font-semibold text-content-primary mb-1">Edit Profile</h3>
                    <p class="text-xs text-content-tertiary">Update this user's basic account details.</p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary mb-1">Full name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary mb-1">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-content-tertiary mb-1">Country</label>
                        <input type="text" name="country" value="{{ old('country', $user->country) }}" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Phone (optional)" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Save Profile</button>
            </form>
        </div>

        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <form method="POST" action="{{ url('/admin/users/' . $user->id . '/password') }}" class="space-y-4">
                @csrf
                <div>
                    <h3 class="text-sm font-semibold text-content-primary mb-1">Reset Password</h3>
                    <p class="text-xs text-content-tertiary">Set a new password for this user's login.</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-content-tertiary mb-1">New password</label>
                    <input type="password" name="password" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-xs font-medium text-content-tertiary mb-1">Confirm password</label>
                    <input type="password" name="password_confirmation" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                </div>
                <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Reset Password</button>
            </form>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border">
                <h3 class="text-sm font-semibold text-content-primary">Recent Activity</h3>
            </div>
            <div class="divide-y divide-surface-border max-h-96 overflow-y-auto">
                @forelse($transactions as $transaction)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-content-primary truncate">{{ $transaction->title }}</p>
                            <p class="text-xs text-content-tertiary">{{ $transaction->created_at->format('M j, Y H:i') }}</p>
                        </div>
                        <span class="text-sm font-semibold {{ $transaction->amount >= 0 ? 'text-gain' : 'text-loss' }}">
                            {{ $transaction->amount >= 0 ? '+' : '' }}${{ number_format(abs($transaction->amount), 2) }}
                        </span>
                    </div>
                @empty
                    <p class="px-5 py-8 text-center text-sm text-content-tertiary">No transactions.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border">
                <h3 class="text-sm font-semibold text-content-primary">Loans & Investments</h3>
            </div>
            <div class="divide-y divide-surface-border max-h-96 overflow-y-auto">
                @foreach($user->investments as $investment)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-content-primary">{{ $investment->plan_name }}</p>
                            <p class="text-xs text-content-tertiary">Investment · ends {{ $investment->end_date }}</p>
                        </div>
                        <span class="text-sm font-semibold text-content-primary">${{ number_format($investment->amount, 2) }}</span>
                    </div>
                @endforeach
                @foreach($user->loans as $loan)
                    <div class="px-5 py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-content-primary">{{ $loan->plan_name }}</p>
                            <p class="text-xs text-content-tertiary">Loan · {{ $loan->status }}</p>
                        </div>
                        <span class="text-sm font-semibold text-content-primary">${{ number_format($loan->amount, 2) }}</span>
                    </div>
                @endforeach
                @if($user->investments->isEmpty() && $user->loans->isEmpty())
                    <p class="px-5 py-8 text-center text-sm text-content-tertiary">No investments or loans.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection