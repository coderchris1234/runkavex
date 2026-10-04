@extends('layouts.sub')

@section('content')

<section class="bg-body-bg py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="font-serif text-3xl md:text-4xl font-bold text-body-text">Market News</h1>
        <p class="text-body-muted text-lg mt-3">Insights and updates from the Runkavex Capital research desk</p>
    </div>
</section>

<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <a href="{{ route('news.show', $article) }}" class="group bg-white rounded-xl border border-body-border overflow-hidden hover:shadow-lg transition-shadow flex flex-col">
                    @if($article->image)
                        <div class="aspect-[16/9] bg-body-bg overflow-hidden">
                            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        </div>
                    @else
                        <div class="aspect-[16/9] bg-primary-subtle flex items-center justify-center">
                            <svg class="w-12 h-12 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                    <div class="p-5 flex flex-col flex-1">
                        <p class="text-xs font-medium text-primary uppercase tracking-wider">{{ $article->published_at ? $article->published_at->format('M j, Y') : '' }}</p>
                        <h2 class="text-lg font-serif font-bold text-body-text mt-2 group-hover:text-primary transition-colors leading-snug">{{ $article->title }}</h2>
                        @if($article->excerpt)
                            <p class="text-body-muted text-sm mt-2 leading-relaxed line-clamp-2">{{ $article->excerpt }}</p>
                        @endif
                        <div class="mt-4 flex items-center justify-between pt-4 border-t border-body-border">
                            <span class="text-xs text-body-muted">{{ $article->author ?? 'Research Desk' }}</span>
                            <span class="text-sm font-medium text-primary inline-flex items-center gap-1">Read article
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-body-muted py-16">No news published yet.</div>
            @endforelse
        </div>
    </div>
</section>

@endsection