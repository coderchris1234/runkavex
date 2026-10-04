@extends('layouts.auth')
@section('content')

<div class="w-full max-w-md mx-auto">

    @if(session('status'))
    <div class="mb-4 rounded-lg border border-gain/30 bg-gain/10 px-4 py-3 text-sm text-gain">
        <span>{{ session('status') }}</span>
        @if(session('reset_link'))
        <div class="mt-3">
            <p class="text-xs text-content-tertiary mb-1">Since email delivery is not configured on this demo, use the link below:</p>
            <a href="{{ session('reset_link') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white text-xs font-medium transition-colors break-all">
                {{ session('reset_link') }}
            </a>
        </div>
        @endif
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 rounded-lg border border-loss/30 bg-loss/10 px-4 py-3 text-sm text-loss">
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    <div class="text-center mb-8">
        <a href="{{ url('/') }}">
            <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" class="h-12 mx-auto">
        </a>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl p-8">

        <h1 class="text-2xl font-bold text-content-primary mb-1">Forgot Password</h1>
        <p class="text-content-tertiary text-sm mb-6">Don't worry! We will help you recover your password.</p>

        <form method="POST" action="{{ url('/forgot-password') }}">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Email Address</label>
                <input type="email" name="email" required
                    placeholder="Enter your email"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 rounded-lg transition-colors">
                Request Reset Link
            </button>
        </form>

        <div class="mt-6 text-sm text-content-tertiary space-y-1">
            <p>Did you remember your password?</p>
            <p>Try to <a href="{{ url('/login') }}" class="text-primary-light hover:text-primary transition-colors">Sign in</a></p>
        </div>
    </div>
</div>

@endsection
