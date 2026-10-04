@php
    $active = $course ? 'my-courses' : 'courses';
    $headerTitle = $lesson->title;
    $isYoutube = false;
    $youtubeId = null;
    if ($lesson->video_url) {
        preg_match('/(?:youtu\.be\/|\/embed\/|[?&]v=)([A-Za-z0-9_-]{11})/', $lesson->video_url, $m);
        if (!empty($m[1])) {
            $isYoutube = true;
            $youtubeId = $m[1];
        }
    }
@endphp

@extends('layouts.dashboard')

@section('pageTitle', $lesson->title)

@section('content')

    <div class="p-4 lg:p-6 space-y-6">

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-loss/30 bg-loss/10 px-4 py-3 text-sm text-loss">
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    <div class="flex flex-wrap gap-2 mb-6">
        @if($course)
            <a href="{{ url('') }}/dashboard/course-details/{{ $course->slug }}/{{ $course->id }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
                bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
                {{ $course->title }}
            </a>
        @else
            <a href="{{ url('') }}/dashboard/courses" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
                bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
                All Courses
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
                <div class="aspect-video bg-black/40 relative">
                    @if($lesson->video_url)
                        @if($isYoutube)
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                title="{{ $lesson->title }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        @else
                            <video class="w-full h-full object-contain" controls preload="metadata"
                                poster="{{ $course->image_url ?? '' }}">
                                <source src="{{ $lesson->video_url }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-center px-6">
                            <div class="w-20 h-20 rounded-full bg-primary/20 flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-primary">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"></path>
</svg>
                            </div>
                            <p class="text-sm text-content-secondary">Video lesson player</p>
                            <p class="text-xs text-content-tertiary mt-1">The lecture video will play here once published.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    @if($lesson->category)
                    <span class="text-xs font-medium px-2.5 py-1 rounded-md bg-surface-overlay text-content-secondary">{{ $lesson->category }}</span>
                    @endif
                    <span class="text-xs font-medium px-2.5 py-1 rounded-md bg-primary/10 text-primary">
                        {{ gmdate('i:s', $lesson->duration_seconds ?? 0) }}
                    </span>
                </div>
                <h1 class="text-2xl font-bold text-content-primary">{{ $lesson->title }}</h1>
                <p class="text-sm text-content-secondary mt-3 leading-relaxed">{{ $lesson->description }}</p>
            </div>

            <div class="flex items-center justify-between gap-3">
                @if($prev)
                    <a href="{{ url('') }}/dashboard/learning/{{ $prev->id }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-overlay border border-surface-border hover:border-primary/50 text-content-primary text-sm font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
</svg>
                        Previous Lesson
                    </a>
                @else
                    <span></span>
                @endif
                @if($next)
                    <a href="{{ url('') }}/dashboard/learning/{{ $next->id }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium transition-colors">
                        Next Lesson
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
</svg>
                    </a>
                @endif
            </div>
        </div>

        @if($course)
        <div class="bg-surface-raised border border-surface-border rounded-xl h-fit">
            <div class="p-4 border-b border-surface-border">
                <h3 class="text-sm font-semibold text-content-primary">Course Lessons</h3>
            </div>
            <div class="p-2 space-y-1 max-h-[32rem] overflow-y-auto">
                @foreach($siblings as $sib)
                    <a href="{{ url('') }}/dashboard/learning/{{ $sib->id }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ $sib->id == $lesson->id ? 'bg-primary/10 text-primary' : 'text-content-secondary hover:bg-surface-overlay hover:text-content-primary' }}">
                        <div class="{{ $sib->id == $lesson->id ? 'w-8 h-8 rounded-full bg-primary/20 text-primary' : 'w-8 h-8 rounded-full bg-surface-overlay' }} flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"></path>
</svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium truncate">{{ $sib->title }}</p>
                            <p class="text-xs text-content-tertiary">{{ gmdate('i:s', $sib->duration_seconds ?? 0) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    </div>

@endsection