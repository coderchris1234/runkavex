@php $active = 'notification'; $headerTitle = 'Notifications'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Notifications')

@section('content')

<div class="p-4 lg:p-6 space-y-6">
    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <div class="px-5 py-4 border-b border-surface-border flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"></path>
</svg>
                <h3 class="text-sm font-semibold text-content-primary">All Notifications</h3>
            </div>
        </div>

        @forelse($notifications as $notification)
            <div class="px-5 py-4 border-b border-surface-border flex items-start gap-3 {{ $notification->is_read ? 'opacity-60' : '' }}">
                <div class="w-9 h-9 rounded-full bg-primary-subtle flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"></path>
</svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-content-primary">{{ $notification->title }}</p>
                    @if($notification->message)
                        <p class="text-sm text-content-secondary mt-1 whitespace-pre-line">{{ $notification->message }}</p>
                    @endif
                    <p class="text-[11px] text-content-tertiary mt-1.5">{{ $notification->created_at->format('M j, Y H:i') }}</p>
                </div>
                @if(! $notification->is_read)
                    <span class="w-2 h-2 rounded-full bg-primary shrink-0 mt-2" title="Unread"></span>
                @endif
            </div>
        @empty
            <div class="px-5 py-14 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-content-tertiary mx-auto mb-2" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"></path>
</svg>
                <p class="text-sm text-content-tertiary">No notifications yet</p>
            </div>
        @endforelse

        @if($notifications->hasPages())
            <div class="px-5 py-3 border-t border-surface-border">{{ $notifications->links() }}</div>
        @endif
    </div>
</div>

@endsection