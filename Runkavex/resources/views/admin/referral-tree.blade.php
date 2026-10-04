@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div>
        <a href="{{ route('admin.referrals') }}" class="text-xs text-content-tertiary hover:text-content-primary mb-1 inline-block">&larr; Back to referrals</a>
        <h2 class="text-xl font-bold text-content-primary">Referral Tree: {{ $user->name }}</h2>
        <p class="text-sm text-content-secondary mt-1">Code: <span class="text-content-primary">{{ $user->referral_code }}</span></p>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Direct Referrals</p>
            <p class="text-2xl font-bold text-content-primary mt-1">{{ $refs->count() }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Bonus</p>
            <p class="text-2xl font-bold text-content-primary mt-1">${{ number_format($user->bonus, 2) }}</p>
        </div>
        <div class="bg-surface-raised border border-surface-border rounded-xl p-4">
            <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide">Referral Bonus</p>
            <p class="text-2xl font-bold text-content-primary mt-1">${{ number_format($user->referral_bonus, 2) }}</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-4">
        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-3 border-b border-surface-border">
                <h3 class="text-sm font-semibold text-content-primary">Direct Referrals</h3>
            </div>
            <div class="divide-y divide-surface-border">
                @forelse($refs as $ref)
                    <a href="{{ route('admin.users.show', $ref) }}" class="flex items-center justify-between px-5 py-3 hover:bg-surface-overlay transition-colors">
                        <div>
                            <p class="text-sm font-medium text-content-primary">{{ $ref->name }}</p>
                            <p class="text-xs text-content-tertiary">{{ $ref->email }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-content-primary">${{ number_format($ref->balance, 2) }}</p>
                            <p class="text-xs text-content-tertiary">{{ $ref->created_at->format('M j, Y') }}</p>
                        </div>
                    </a>
                @empty
                    <p class="px-5 py-8 text-center text-sm text-content-tertiary">No direct referrals yet.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
            <form method="POST" action="{{ url('/admin/referrals/' . $user->id . '/bonus') }}" class="space-y-4">
                @csrf
                <div>
                    <h3 class="text-sm font-semibold text-content-primary mb-1">Adjust Bonus</h3>
                    <p class="text-xs text-content-tertiary">Add to or subtract from this user's bonus balances.</p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <select name="type" class="bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        <option value="bonus">Bonus</option>
                        <option value="referral_bonus">Referral Bonus</option>
                    </select>
                    <select name="action" class="bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        <option value="add">Add (+)</option>
                        <option value="subtract">Subtract (−)</option>
                    </select>
                </div>
                <input type="number" name="amount" step="0.01" min="0.01" placeholder="Amount" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                <input type="text" name="note" placeholder="Note (optional)" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Apply</button>
            </form>
        </div>
    </div>
</div>

@endsection