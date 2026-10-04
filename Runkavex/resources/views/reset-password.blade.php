@extends('layouts.auth')
@section('content')

<div class="w-full max-w-md mx-auto">

    @if(session('success'))
    <div class="mb-4 rounded-lg border border-gain/30 bg-gain/10 px-4 py-3 text-sm text-gain">
        <span>{{ session('success') }}</span>
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

        <h1 class="text-2xl font-bold text-content-primary mb-1">Reset Password</h1>
        <p class="text-content-tertiary text-sm mb-6">Choose a new password for your account.</p>

        <form method="POST" action="{{ url('/reset-password/' . $token) }}">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Email Address</label>
                <input type="email" name="email" value="{{ $email }}" required readonly
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">New Password</label>
                <input type="password" name="password" required minlength="6" placeholder="Enter a new password"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Confirm New Password</label>
                <input type="password" name="password_confirmation" required minlength="6" placeholder="Confirm new password"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 rounded-lg transition-colors">
                Reset Password
            </button>
        </form>

        <div class="mt-6 text-sm text-content-tertiary space-y-1">
            <p>Remembered your password?</p>
            <p><a href="{{ url('/login') }}" class="text-primary-light hover:text-primary transition-colors">Sign in</a></p>
        </div>
    </div>
</div>

@endsection