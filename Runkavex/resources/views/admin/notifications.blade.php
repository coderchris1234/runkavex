@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ openSend: false }">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Notifications</h2>
            <p class="text-sm text-content-secondary mt-1">Send announcements to users or broadcast to everyone</p>
        </div>
        <button @click="openSend = true" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">+ Send Notification</button>
    </div>

    <form method="GET" action="{{ route('admin.notifications') }}" class="flex gap-3">
        <select name="scope" onchange="this.form.submit()" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="" {{ $scopeFilter === '' ? 'selected' : '' }}>All notifications</option>
            <option value="broadcast" {{ $scopeFilter === 'broadcast' ? 'selected' : '' }}>Broadcasts</option>
            <option value="targeted" {{ $scopeFilter === 'targeted' ? 'selected' : '' }}>Targeted</option>
        </select>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Title</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Message</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Target</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Read</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Sent</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($notifications as $notification)
                        <tr>
                            <td class="px-5 py-3 font-medium text-content-primary">{{ $notification->title }}</td>
                            <td class="px-5 py-3 text-content-secondary text-xs max-w-[20rem] truncate">{{ $notification->message }}</td>
                            <td class="px-5 py-3">
                                @if($notification->is_broadcast)
                                    <span class="px-2 py-0.5 text-xs font-medium rounded bg-primary/10 text-primary">Broadcast</span>
                                @elseif($notification->user)
                                    <a href="{{ route('admin.users.show', $notification->user) }}" class="text-content-secondary hover:text-primary">{{ $notification->user->name }}</a>
                                @else
                                    <span class="text-content-tertiary">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 {{ $notification->is_read ? 'text-content-tertiary' : 'text-warning' }}">{{ $notification->is_read ? 'Read' : 'Unread' }}</td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $notification->created_at->format('M j, Y H:i') }}</td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ url('/admin/notifications/' . $notification->id) }}" @submit="confirm('Remove this notification?')" x-data>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-loss/70 hover:text-loss font-medium transition-colors">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-8 text-center text-content-tertiary">No notifications yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $notifications->links() }}</div>
    </div>

    <div x-show="openSend" x-cloak class="fixed inset-0 bg-black/60 z-40" @click="openSend = false"></div>
    <div x-show="openSend" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-lg bg-surface-raised border border-surface-border rounded-xl p-6">
            <h3 class="text-lg font-bold text-content-primary mb-4">Send Notification</h3>
            <form method="POST" action="{{ route('admin.notifications') }}" class="space-y-4" x-data="{ target: 'all', selected: [] }">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Title</label>
                    <input type="text" name="title" required maxlength="200" placeholder="e.g. New trading signals available"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Message</label>
                    <textarea name="message" required rows="4" placeholder="Notification body..."
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Target</label>
                    <div class="grid grid-cols-2 gap-2">
                        <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-surface-border text-sm text-content-secondary cursor-pointer" :class="target === 'all' ? 'border-primary text-content-primary' : ''">
                            <input type="radio" name="target" value="all" x-model="target" class="accent-primary">
                            All users (broadcast)
                        </label>
                        <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-surface-border text-sm text-content-secondary cursor-pointer" :class="target === 'user' ? 'border-primary text-content-primary' : ''">
                            <input type="radio" name="target" value="user" x-model="target" class="accent-primary">
                            Specific users
                        </label>
                    </div>
                </div>
                <template x-if="target === 'user'">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Select users</label>
                        <select name="user_ids[]" multiple size="6" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-content-tertiary mt-1">Hold Ctrl/Cmd to select multiple.</p>
                    </div>
                </template>
                <div class="flex gap-2 pt-1">
                    <button type="submit" class="flex-1 px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Send Notification</button>
                    <button type="button" @click="openSend = false" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection