@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md mx-auto">

    <div class="text-center mb-8">
        <a href="{{ url('/') }}">
            <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" class="h-12 mx-auto">
        </a>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl p-8">

        <div class="flex items-center gap-2 mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"></path>
</svg>
            <h1 class="text-2xl font-bold text-content-primary">Admin Sign In</h1>
        </div>
        <p class="text-content-tertiary text-sm mb-6">Restricted access — authorized staff only.</p>

        @if($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-loss/10 border border-loss/20 text-loss text-sm">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ url('/admin/login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Email or Username</label>
                <input type="text" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="Email or Username"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Password</label>
                <input type="password" name="password" required
                    placeholder="Enter your password"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 rounded-lg transition-colors">
                Sign In to Admin
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-content-tertiary">
            <a href="{{ url('/login') }}" class="text-primary-light hover:text-primary transition-colors">Back to client login</a>
        </p>
    </div>
</div>
@endsection