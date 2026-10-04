@extends('layouts.sub')

@section('content')

<section class="bg-body-bg py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="font-serif text-3xl md:text-4xl font-bold text-body-text">{{ $article->title }}</h1>
        <div class="flex items-center justify-center gap-2 mt-3 text-sm text-body-muted">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ url('/news') }}" class="hover:text-primary transition">News</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-primary">{{ $article->title }}</span>
        </div>
        <p class="text-sm text-body-muted mt-4">
            {{ $article->author ?? 'Research Desk' }}
            &middot;
            {{ $article->published_at ? $article->published_at->format('M j, Y') : '' }}
        </p>
    </div>
</section>

<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        @if($article->image)
            <div class="rounded-xl overflow-hidden border border-body-border mb-10">
                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full object-cover" loading="lazy">
            </div>
        @endif
        <article class="prose prose-sm max-w-none text-body-muted leading-relaxed space-y-6">
            {!! $article->body !!}
        </article>
    </div>
</section>

@if($related->isNotEmpty())
    <section class="bg-body-bg py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <h2 class="font-serif text-2xl font-bold text-body-text mb-8">More from the news desk</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $item)
                    <a href="{{ route('news.show', $item) }}" class="group bg-white rounded-xl border border-body-border p-5 hover:shadow-lg transition-shadow">
                        <p class="text-xs font-medium text-primary uppercase tracking-wider">{{ $item->published_at ? $item->published_at->format('M j, Y') : '' }}</p>
                        <h3 class="font-serif font-bold text-body-text mt-2 leading-snug group-hover:text-primary transition-colors">{{ $item->title }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

@endsection