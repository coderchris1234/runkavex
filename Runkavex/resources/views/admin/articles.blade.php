@extends('layouts.admin')

@section('content')

<div class="space-y-6" x-data="{ editting: null }">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-content-primary">Articles</h2>
            <p class="text-sm text-content-secondary mt-1">News&nbsp;&amp; editorial content shown on the public news page</p>
        </div>
        <button @click="editting = { id: null, title: '', slug: '', excerpt: '', body: '', image: '', author: '', is_published: 1 }"
            class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">+ New Article</button>
    </div>

    @if(session('success'))
        <div class="p-3 rounded-lg bg-gain/10 border border-gain/20 text-gain text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-surface-border">
                    <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Article</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Author</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-content-tertiary uppercase tracking-wider">Published</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-content-tertiary uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse($articles as $article)
                    <tr class="hover:bg-surface-overlay/50 transition-colors">
                        <td class="px-4 py-3">
                            <p class="font-semibold text-content-primary">{{ $article->title }}</p>
                            <p class="text-xs text-content-tertiary mt-0.5">{{ $article->slug }} &middot; {{ $article->published_at ? $article->published_at->format('M j, Y') : 'Unpublished' }}</p>
                        </td>
                        <td class="px-4 py-3 text-content-secondary">{{ $article->author ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-xs font-medium rounded {{ $article->is_published ? 'bg-gain/10 text-gain' : 'bg-loss/10 text-loss' }}">{{ $article->is_published ? 'Live' : 'Draft' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('news.show', $article) }}" target="_blank" class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary transition-colors">View</a>
                                <button @click='editting = { id: {{ $article->id }}, title: "{{ addslashes($article->title) }}", slug: "{{ addslashes($article->slug) }}", excerpt: "{!! addslashes($article->excerpt ?? '') !!}", body: {!! json_encode($article->body) !!}, image: "{{ addslashes($article->image ?? '') }}", author: "{{ addslashes($article->author ?? '') }}", is_published: {{ $article->is_published ? 1 : 0 }} }'
                                    class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary transition-colors">Edit</button>
                                <form method="POST" action="{{ url('/admin/articles/' . $article->id . '/toggle') }}">
                                    @csrf
                                    <button type="submit" class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-content-primary transition-colors">{{ $article->is_published ? 'Unpublish' : 'Publish' }}</button>
                                </form>
                                <form method="POST" action="{{ url('/admin/articles/' . $article->id) }}" @submit="confirm('Delete this article?')" x-data>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-loss/10 text-loss hover:bg-loss/20 transition-colors">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-content-tertiary text-sm">No articles yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $articles->links() }}

    <div x-show="editting !== null" x-cloak class="fixed inset-0 bg-black/60 z-40"></div>
    <div x-show="editting !== null" x-cloak x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-2xl bg-surface-raised border border-surface-border rounded-xl p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-content-primary mb-4" x-text="editting.id ? 'Edit Article' : 'New Article'"></h3>
            <form :action="editting.id ? '/admin/articles/' + editting.id : '/admin/articles'" method="POST" class="space-y-4">
                @csrf
                <template x-if="editting.id">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Title</label>
                    <input type="text" name="title" x-model="editting.title" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Slug</label>
                        <input type="text" name="slug" x-model="editting.slug" placeholder="leave blank to auto-generate" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-content-secondary mb-1">Author</label>
                        <input type="text" name="author" x-model="editting.author" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Cover Image URL</label>
                    <input type="text" name="image" x-model="editting.image" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Excerpt</label>
                    <textarea name="excerpt" x-model="editting.excerpt" rows="2" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Body (HTML)</label>
                    <textarea name="body" x-model="editting.body" rows="10" required class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary font-mono focus:outline-none focus:border-primary"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1">Visibility</label>
                    <select name="is_published" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2 text-sm text-content-primary focus:outline-none focus:border-primary">
                        <option value="1" x-bind:selected="editting.is_published === 1 || editting.is_published === true">Published (visible on news page)</option>
                        <option value="0" x-bind:selected="editting.is_published === 0 || editting.is_published === false">Draft (hidden)</option>
                    </select>
                </div>
                <div class="flex gap-3 justify-end pt-2">
                    <button type="button" @click="editting = null" class="px-4 py-2 rounded-lg bg-surface-overlay border border-surface-border text-sm text-content-secondary hover:text-content-primary transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">Save Article</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection