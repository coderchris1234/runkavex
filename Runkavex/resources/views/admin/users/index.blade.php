@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ openCreate: false }">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Users</h2>
            <p class="text-sm text-content-secondary mt-1">{{ $users->total() }} registered accounts</p>
        </div>
        <button @click="openCreate = true" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">+ New User</button>
    </div>

    <form method="GET" action="{{ route('admin.users') }}" class="flex flex-wrap gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name, email, username..."
            class="w-64 bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
        <select name="status" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="">All statuses</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Deactivated</option>
            <option value="admin" {{ request('status') === 'admin' ? 'selected' : '' }}>Admins</option>
        </select>
        <button type="submit" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Filter</button>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Email</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Balance</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Deposits</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Role</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Joined</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-5 py-3">
                                <p class="font-medium text-content-primary">{{ $user->name }}</p>
                                <p class="text-xs text-content-tertiary">{{ $user->username }}</p>
                            </td>
                            <td class="px-5 py-3 text-content-secondary">{{ $user->email }}</td>
                            <td class="px-5 py-3 font-semibold text-content-primary">${{ number_format($user->balance, 2) }}</td>
                            <td class="px-5 py-3 text-content-secondary">{{ $user->deposits_count }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded {{ $user->is_admin ? 'bg-primary/10 text-primary' : 'bg-surface-overlay text-content-tertiary' }}">{{ $user->is_admin ? 'Admin' : 'User' }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded {{ $user->is_active ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ $user->is_active ? 'Active' : 'Off' }}</span>
                            </td>
                            <td class="px-5 py-3 text-content-tertiary">{{ $user->created_at->format('M j, Y') }}</td>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.users.show', $user) }}" class="text-primary hover:text-primary-light text-xs font-medium">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-5 py-8 text-center text-content-tertiary">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $users->links() }}</div>
    </div>

    <div>
        <div x-show="openCreate" x-cloak class="fixed inset-0 bg-black/60 z-40" @click="openCreate = false"></div>
        <div x-show="openCreate" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-lg font-bold text-content-primary mb-4">Create User</h3>
                <form method="POST" action="{{ url('/admin/users/create') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1">Name</label>
                            <input type="text" name="name" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1">Username</label>
                            <input type="text" name="username" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Email</label>
                        <input type="email" name="email" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1">Phone</label>
                            <input type="text" name="phone" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1">Country</label>
                            <input type="text" name="country" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1">Opening Balance</label>
                            <input type="number" name="balance" step="0.01" min="0" value="0" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-content-secondary mb-1">Password</label>
                            <input type="password" name="password" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        </div>
                    </div>
                    <label class="flex items-center gap-2 text-sm text-content-secondary">
                        <input type="checkbox" name="is_admin" value="1" class="rounded border-surface-border">
                        Grant admin access
                    </label>
                    <div class="flex gap-2 pt-2">
                        <button type="submit" class="flex-1 px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Create</button>
                        <button type="button" @click="openCreate = false" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection