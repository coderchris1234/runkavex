@extends('layouts.admin')

@section('content')

<div class="space-y-6">
    <div>
        <h2 class="text-xl font-bold text-content-primary">Content Editor</h2>
        <p class="text-sm text-content-secondary mt-1">Edit text shown on public pages. Leave blank to use defaults.</p>
    </div>

    <form method="GET" action="{{ route('admin.cms') }}">
        <select name="page" onchange="this.form.submit()" class="bg-surface-overlay border border-surface-border rounded-lg px-4 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
            <option value="">All pages</option>
            @foreach($pages as $page)
                <option value="{{ $page }}" {{ $selectedPage === $page ? 'selected' : '' }}>{{ $page }}</option>
            @endforeach
        </select>
    </form>

    <form method="POST" action="{{ route('admin.cms') }}" class="space-y-4">
        @csrf
        @foreach($sections as $page => $pageSections)
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
                <div class="px-5 py-3 border-b border-surface-border">
                    <h3 class="text-sm font-semibold text-content-primary">{{ $page }}</h3>
                </div>
                <div class="divide-y divide-surface-border">
                    @foreach($pageSections as $section)
                        <div class="px-5 py-4">
                            <label class="block text-sm font-medium text-content-secondary mb-2">{{ $section->title }} <span class="text-xs text-content-tertiary">({{ $section->key }})</span></label>
                            <textarea name="sections[{{ $section->key }}]" rows="3"
                                class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">{{ $section->content }}</textarea>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Save Content</button>
    </form>
</div>

@endsection