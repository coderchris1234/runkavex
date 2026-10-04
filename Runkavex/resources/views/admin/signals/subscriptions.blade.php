@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Signal Subscriptions</h2>
            <p class="text-sm text-content-secondary mt-1">Approve or reject user signal plan subscriptions</p>
        </div>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Plan</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Price</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Duration</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Valid until</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($subscriptions as $subscription)
                        <tr>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $subscription->user) }}" class="font-medium text-content-primary hover:text-primary">{{ $subscription->user->name }}</a>
                                <p class="text-xs text-content-tertiary">{{ $subscription->created_at->format('M j, H:i') }}</p>
                            </td>
                            <td class="px-5 py-3 text-content-primary">{{ $subscription->plan->name }}</td>
                            <td class="px-5 py-3 font-semibold text-content-primary">${{ number_format($subscription->price, 2) }}</td>
                            <td class="px-5 py-3 text-content-secondary">{{ $subscription->plan->duration }} week{{ $subscription->plan->duration > 1 ? 's' : '' }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $subscription->status === 'active' ? 'bg-gain/10 text-gain' : ($subscription->status === 'rejected' ? 'bg-loss/10 text-loss' : 'bg-warning/10 text-warning') }}">{{ $subscription->status }}</span>
                            </td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $subscription->ends_at?->format('M j, Y') }}</td>
                            <td class="px-5 py-3">
                                @if($subscription->status === 'pending')
                                    <div class="flex gap-1.5">
                                        <form method="POST" action="{{ url('/admin/signals/' . $subscription->id . '/approve') }}" @submit="confirm('Deduct $' + {{ $subscription->price }} + ' from user balance and activate?')" x-data>
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-gain/10 text-gain hover:bg-gain/20 transition-colors">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ url('/admin/signals/' . $subscription->id . '/reject') }}" @submit="confirm('Reject this subscription?')" x-data>
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Reject</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-content-tertiary">{{ $subscription->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-8 text-center text-content-tertiary">No subscriptions found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $subscriptions->links() }}</div>
    </div>
</div>

@endsection