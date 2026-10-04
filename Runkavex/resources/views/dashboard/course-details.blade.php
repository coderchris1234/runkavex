@php $active = 'courses'; $headerTitle = $course->title; @endphp

@extends('layouts.dashboard')

@section('pageTitle', $course->title)

@section('content')

    <div class="p-4 lg:p-6 space-y-6">

    @if(session('success'))
    <div class="mb-4 rounded-lg border border-gain/30 bg-gain/10 px-4 py-3 text-sm text-gain">
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if(session('info'))
    <div class="mb-4 rounded-lg border border-info/30 bg-info/10 px-4 py-3 text-sm text-info">
        <span>{{ session('info') }}</span>
    </div>
    @endif
    @if($errors->any())
    <div class="mb-4 rounded-lg border border-loss/30 bg-loss/10 px-4 py-3 text-sm text-loss">
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ url('') }}/dashboard/courses" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"></path>
</svg>
            All Courses
        </a>
        <a href="{{ url('') }}/dashboard/my-courses" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition-colors
            bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"></path>
</svg>
            My Course(s)
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $course->image_url }}" class="w-full h-full object-cover" alt="{{ $course->title }}" loading="lazy">
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        @if($course->category)
                        <span class="text-xs font-medium px-2.5 py-1 rounded-md bg-surface-overlay text-content-secondary">{{ $course->category }}</span>
                        @endif
                        <span class="text-xs font-medium px-2.5 py-1 rounded-md bg-primary/10 text-primary">{{ $lessons->count() }} Lessons</span>
                        @if($course->price > 0)
                        <span class="text-xs font-medium px-2.5 py-1 rounded-md bg-gain/10 text-gain">${{ number_format((float) $course->price, 2) }}</span>
                        @else
                        <span class="text-xs font-medium px-2.5 py-1 rounded-md bg-gain/10 text-gain">Free</span>
                        @endif
                    </div>
                    <h1 class="text-2xl font-bold text-content-primary">{{ $course->title }}</h1>
                    <p class="text-sm text-content-secondary mt-3 leading-relaxed">{{ $course->description }}</p>

                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        @if($enrolled)
                            <a href="{{ url('') }}/dashboard/learning/{{ $lessons->first()->id ?? 0 }}"
                               class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"></path>
</svg>
                                Start Learning
                            </a>
                        @else
                            <form method="POST" action="{{ url('') }}/dashboard/courses/enroll/{{ $course->id }}">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"></path>
</svg>
                                    @if($course->price > 0)
                                        Get for ${{ number_format((float) $course->price, 2) }}
                                    @else
                                        Get Free
                                    @endif
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h2 class="text-lg font-bold text-content-primary mb-4">Course Contents</h2>
                <div class="space-y-2">
                    @forelse($lessons as $lesson)
                        <div class="flex items-center justify-between gap-3 rounded-lg border border-surface-border bg-surface-overlay px-4 py-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"></path>
</svg>
                                </div>
                                <div class="min-w-0">
                                    <h6 class="text-sm font-medium text-content-primary truncate">{{ $lesson->title }}</h6>
                                    <p class="text-xs text-content-tertiary mt-0.5">{{ $lesson->description }}</p>
                                </div>
                            </div>
                            <span class="text-xs text-content-tertiary whitespace-nowrap">
                                {{ gmdate('i:s', $lesson->duration_seconds ?? 0) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-content-tertiary">No lessons have been published for this course yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-sm font-semibold text-content-primary uppercase tracking-wider mb-4">Enrollment</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-content-secondary">Price</span>
                        <span class="font-semibold text-content-primary">
                            @if($course->price > 0)
                                ${{ number_format((float) $course->price, 2) }}
                            @else
                                Free
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-content-secondary">Lessons</span>
                        <span class="font-semibold text-content-primary">{{ $lessons->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-content-secondary">Status</span>
                        <span class="font-semibold {{ $enrolled ? 'text-gain' : 'text-content-primary' }}">{{ $enrolled ? 'Enrolled' : 'Not enrolled' }}</span>
                    </div>
                </div>
                <div class="border-t border-dashed border-surface-border my-4"></div>
                @if($enrolled)
                    <a href="{{ url('') }}/dashboard/learning/{{ $lessons->first()->id ?? 0 }}"
                       class="w-full inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
                        Open Course
                    </a>
                @else
                    <form method="POST" action="{{ url('') }}/dashboard/courses/enroll/{{ $course->id }}">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
                            @if($course->price > 0)
                                Purchase for ${{ number_format((float) $course->price, 2) }}
                            @else
                                Enroll Free
                            @endif
                        </button>
                    </form>
                @endif
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl p-6">
                <h3 class="text-sm font-semibold text-content-primary uppercase tracking-wider mb-3">What you'll learn</h3>
                <ul class="space-y-2 text-sm text-content-secondary">
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        Practical, hands-on lessons
                    </li>
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        Learn at your own pace
                    </li>
                    <li class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gain flex-shrink-0 mt-0.5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
                        Lifetime access after enrollment
                    </li>
                </ul>
            </div>
        </div>
    </div>

    </div>

@endsection