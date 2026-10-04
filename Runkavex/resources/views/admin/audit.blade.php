@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div>
        <h2 class="text-xl font-bold text-content-primary">Audit Log</h2>
        <p class="text-sm text-content-secondary mt-1">Trail of every admin action on the platform</p>
    </div>

    <form method="GET" action="{{ route('admin.audit') }}" class="flex flex-wrap gap-3">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search actions..."
            class="w-72 bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary">
        <button type="submit" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary text-sm font-medium transition-colors">Filter</button>
    </form>

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-surface-border">
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">When</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Admin</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Action</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Description</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($logs as $log)
                        <tr>
                            <td class="px-5 py-3 text-content-tertiary whitespace-nowrap">{{ $log->created_at->format('M j, Y H:i') }}</td>
                            <td class="px-5 py-3 text-content-primary">{{ $log->admin?->name ?? 'System' }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded bg-surface-overlay text-content-secondary">{{ $log->action }}</span>
                            </td>
                            <td class="px-5 py-3 text-content-secondary">{{ $log->description }}</td>
                            <td class="px-5 py-3 text-content-tertiary text-xs">{{ $log->ip }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-8 text-center text-content-tertiary">No audit entries yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-3 border-t border-surface-border">{{ $logs->links() }}</div>
    </div>
</div>

@endsection