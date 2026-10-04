@extends('layouts.admin')

@section('content')

<div class="max-w-3xl space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <a href="{{ route('admin.support') }}" class="text-xs text-content-tertiary hover:text-content-primary mb-1 inline-block">&larr; Back to tickets</a>
            <h2 class="text-xl font-bold text-content-primary">{{ $ticket->subject }}</h2>
            <p class="text-sm text-content-secondary mt-1">
                <a href="{{ route('admin.users.show', $ticket->user) }}" class="text-primary hover:text-primary-light">{{ $ticket->user->name }}</a>
                · {{ $ticket->priority }} priority · {{ $ticket->reference }}
            </p>
        </div>
        <span class="px-2 py-1 text-xs font-medium rounded uppercase {{ $ticket->status === 'closed' ? 'bg-loss/10 text-loss' : 'bg-gain/10 text-gain' }}">{{ $ticket->status }}</span>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl p-5">
        <p class="text-xs text-content-tertiary font-medium uppercase tracking-wide mb-2">Original message · {{ $ticket->created_at->format('M j, Y H:i') }}</p>
        <p class="text-sm text-content-primary leading-relaxed whitespace-pre-line">{{ $ticket->message }}</p>
    </div>

    @if($ticket->admin_reply)
        <div class="bg-primary/5 border border-primary/20 rounded-xl p-5">
            <p class="text-xs text-primary font-medium uppercase tracking-wide mb-2">Your reply · {{ $ticket->replied_at?->format('M j, Y H:i') }}</p>
            <p class="text-sm text-content-primary leading-relaxed whitespace-pre-line">{{ $ticket->admin_reply }}</p>
        </div>
    @endif

    @if($ticket->status !== 'closed')
        <form method="POST" action="{{ url('/admin/support/' . $ticket->id . '/reply') }}" class="bg-surface-raised border border-surface-border rounded-xl p-5 space-y-3">
            @csrf
            <label class="block text-sm font-semibold text-content-primary">Reply to {{ $ticket->user->name }}</label>
            <textarea name="admin_reply" rows="5" required placeholder="Type your reply..."
                class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-3 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary"></textarea>
            <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Send Reply</button>
        </form>
        <form method="POST" action="{{ url('/admin/support/' . $ticket->id . '/close') }}" @submit="confirm('Close the ticket?')" x-data
            class="flex items-center justify-between bg-surface-raised border border-surface-border rounded-xl p-5">
            @csrf
            <p class="text-sm text-content-secondary">Done with this ticket?</p>
            <button type="submit" class="px-4 py-2 rounded-lg border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Close Ticket</button>
        </form>
    @else
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5 text-center">
            <p class="text-sm text-content-tertiary">This ticket is closed.</p>
        </div>
    @endif
</div>

@endsection