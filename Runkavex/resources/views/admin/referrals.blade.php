@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div>
        <h2 class="text-xl font-bold text-content-primary">Referrals</h2>
        <p class="text-sm text-content-secondary mt-1">Users with referral codes and their referral activity</p>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Referral Code</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Referrals</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Bonus</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Referral Bonus</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Joined</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $user) }}" class="font-medium text-content-primary hover:text-primary">{{ $user->name }}</a>
                                <p class="text-xs text-content-tertiary">{{ $user->email }}</p>
                            </td>
                            <td class="px-5 py-3"><span class="px-2 py-0.5 text-xs font-medium rounded bg-surface-overlay text-content-secondary">{{ $user->referral_code }}</span></td>
                            <td class="px-5 py-3 text-content-primary">{{ $user->referrals_count }}</td>
                            <td class="px-5 py-3 font-semibold text-content-primary">${{ number_format($user->bonus, 2) }}</td>
                            <td class="px-5 py-3 font-semibold text-content-primary">${{ number_format($user->referral_bonus, 2) }}</td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $user->created_at->format('M j, Y') }}</td>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.referrals.tree', $user) }}" class="text-primary hover:text-primary-light text-xs font-medium">Tree</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-8 text-center text-content-tertiary">No users with referral codes.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $users->links() }}</div>
    </div>
</div>

@endsection