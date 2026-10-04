@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div>
        <h2 class="text-xl font-bold text-content-primary">Support Tickets</h2>
        <p class="text-sm text-content-secondary mt-1">Reply to and resolve user tickets</p>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Subject</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Priority</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Last update</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($tickets as $ticket)
                        <tr>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $ticket->user) }}" class="font-medium text-content-primary hover:text-primary">{{ $ticket->user->name }}</a>
                            </td>
                            <td class="px-5 py-3 text-content-secondary">{{ $ticket->subject }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $ticket->status === 'closed' ? 'bg-loss/10 text-loss' : ($ticket->status === 'replied' ? 'bg-info/10 text-info' : 'bg-warning/10 text-warning') }}">{{ $ticket->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded capitalize {{ $ticket->priority === 'urgent' ? 'bg-loss/10 text-loss' : ($ticket->priority === 'medium' ? 'bg-warning/10 text-warning' : 'bg-gain/10 text-gain') }}">{{ $ticket->priority }}</span>
                            </td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $ticket->updated_at->format('M j, H:i') }}</td>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.support.show', $ticket) }}" class="text-primary hover:text-primary-light text-xs font-medium">Open</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-8 text-center text-content-tertiary">No tickets found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $tickets->links() }}</div>
    </div>
</div>

@endsection