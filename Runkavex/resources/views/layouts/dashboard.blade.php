<!DOCTYPE html><html lang="en" class="h-full"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle', 'Dashboard') | Runkavex Capital</title>
    <link rel="icon" href="{{ asset('brand/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('brand/icon.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" media="all" onload="this.media='all'">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                },
                colors: {
                    surface: {
                        base: '#0B0B0B',
                        raised: '#1B1B1B',
                        overlay: '#232323',
                        border: '#2E2E2E',
                        'border-light': '#3C3C3C',
                    },
                    content: {
                        primary: '#F5F5F4',
                        secondary: '#A1A1AA',
                        tertiary: '#6B7280',
                        inverse: '#0B0B0B',
                    },
                    primary: {
                        DEFAULT: '#16C79A',
                        light: '#3DD8B1',
                        dark: '#0E9E78',
                        subtle: 'rgba(22,199,154,0.12)',
                    },
                    gain: '#00C896',
                    loss: '#FF4D4F',
                    warning: '#F59E0B',
                    info: '#3B82F6',
                },
            },
        },
    }
    </script>
    <style type="text/tailwindcss">
    @layer base {
        [x-cloak] { display: none !important; }
        html { background-color: #0B0B0B; }
        body { font-family: 'Inter', system-ui, sans-serif; color: #9AA0AB; -webkit-font-smoothing: antialiased; }
        select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; -webkit-appearance: none; -moz-appearance: none; appearance: none; padding-right: 2.5rem; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0B0B0B; }
        ::-webkit-scrollbar-thumb { background: #2E2E2E; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #3C3C3C; }
    }
    @layer components {
        .nav-link-active {
            @apply bg-primary-subtle text-primary-light border-l-2 border-primary;
        }
        .nav-link-item {
            @apply flex items-center gap-3 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors duration-150 border-l-2 border-transparent;
        }
        .nav-group-label {
            @apply px-4 pt-5 pb-2 text-xs font-semibold uppercase tracking-wider text-content-tertiary;
        }
        .tab-nav-link {
            @apply inline-flex items-center px-4 py-3 text-sm font-medium whitespace-nowrap text-content-tertiary hover:text-content-secondary transition-colors;
            position: relative;
        }
        .tab-nav-link-active {
            @apply text-primary font-semibold;
        }
        .tab-nav-link-active::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background-color: #16C79A;
        }
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    @stack('head')
</head>
<body class="bg-surface-base font-sans text-content-secondary antialiased min-h-screen" x-data="{
          sidebarOpen: window.innerWidth >= 1024,
          mobileSidebar: false,
          userDropdown: false,
          notifDropdown: false,
      }" @resize.window="sidebarOpen = window.innerWidth >= 1024; if(window.innerWidth >= 1024) mobileSidebar = false">

    <div x-show="mobileSidebar" x-transition.opacity="" class="fixed inset-0 bg-black/60 z-40 lg:hidden" @click="mobileSidebar = false" style="display: none;"></div>

    <aside :class="mobileSidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed top-0 left-0 z-50 h-full w-64 bg-surface-raised border-r border-surface-border flex flex-col transition-transform duration-200 ease-in-out -translate-x-full lg:translate-x-0">

        <div class="flex items-center justify-between h-16 px-4 border-b border-surface-border shrink-0">
            <a href="{{ url('/dashboard') }}" class="flex items-center">
                <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" class="h-8 w-auto max-w-[150px] object-contain">
            </a>
            <button @click="mobileSidebar = false" class="lg:hidden text-content-tertiary hover:text-content-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
</svg>
            </button>
        </div>

        <div class="px-4 py-4 border-b border-surface-border shrink-0">
            <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-surface-overlay flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-content-tertiary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
</svg>
                    </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-content-primary truncate">{{ auth()->user()->name ?? 'Member' }}</p>
                </div>
            </div>
        </div>

        @php
            $tabSections = ['dashboard', 'trade', 'positions', 'markets', 'tradinghistory', 'buy-plan', 'copy-trading', 'expert', 'bot-trading', 'pre-ipo', 'stocks', 'nft-gallery', 'my-nfts', 'nfts/create', 'loans/apply'];
            $hideNavActive = in_array($active ?? '', $tabSections, true);
        @endphp

        <nav class="flex-1 overflow-y-auto py-2">

            <p class="nav-group-label">Overview</p>
            <a href="{{ url('/dashboard') }}" class="nav-link-item {{ ($active ?? '') === 'dashboard' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
</svg>
 Dashboard
            </a>
            <a href="{{ url('/dashboard/portfolio') }}" class="nav-link-item {{ ($active ?? '') === 'portfolio' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"></path>
</svg>
 Portfolio
            </a>

            <p class="nav-group-label">Trading</p>
                        <a href="{{ url('/dashboard/trade') }}" class="nav-link-item {{ ($active ?? '') === 'trade' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
 Open Trade
            </a>
            <a href="{{ url('/dashboard/markets') }}" class="nav-link-item {{ ($active ?? '') === 'markets' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5a17.92 17.92 0 0 1-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"></path>
</svg>
 Markets
            </a>
                                    <a href="{{ url('/dashboard/copy-trading') }}" class="nav-link-item {{ ($active ?? '') === 'copy-trading' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m0 0a9.06 9.06 0 0 1 1.5-.124H15a3.375 3.375 0 0 1 3.375 3.375v1.5"></path>
</svg>
 Copy Trading
            </a>
                        <a href="{{ url('/dashboard/bot-trading') }}" class="nav-link-item {{ ($active ?? '') === 'bot-trading' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"></path>
</svg>
 Bot Trading
            </a>
            <a href="{{ url('/dashboard/tradinghistory') }}" class="nav-link-item {{ ($active ?? '') === 'tradinghistory' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
</svg>
 Trade History
            </a>

            <p class="nav-group-label">Wallet</p>
            <a href="{{ url('/dashboard/deposits') }}" class="nav-link-item {{ ($active ?? '') === 'deposits' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
</svg>
 Deposits
            </a>
                        <a href="{{ url('/dashboard/withdrawals') }}" class="nav-link-item {{ ($active ?? '') === 'withdrawals' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"></path>
</svg>
 Withdrawals
            </a>
                        <a href="{{ url('/dashboard/accounthistory') }}" class="nav-link-item {{ ($active ?? '') === 'accounthistory' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
</svg>
 Transactions
            </a>
                        <a href="{{ url('/dashboard/loans/apply') }}" class="nav-link-item {{ ($active ?? '') === 'loans/apply' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 0 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712.75.75 0 0 0-.75-.75 2.25 2.25 0 0 1-.75-.127v0a2.25 2.25 0 0 1-1.5-2.123V4.575"></path>
</svg>
 Loans
            </a>

            <p class="nav-group-label">Investments</p>
                        <a href="{{ url('/dashboard/buy-plan') }}" class="nav-link-item {{ ($active ?? '') === 'buy-plan' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"></path>
</svg>
 Asset Staking
            </a>
                                    <a href="{{ url('/dashboard/pre-ipo') }}" class="nav-link-item {{ ($active ?? '') === 'pre-ipo' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"></path>
</svg>
 Pre-IPO
            </a>
                                    <a href="{{ url('/dashboard/stocks') }}" class="nav-link-item {{ ($active ?? '') === 'stocks' && !$hideNavActive ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"></path>
</svg>
 Stock Shares
            </a>
<div x-data="{ open: false }">
                <button @click="open = !open" class="w-full nav-link-item flex items-center justify-between {{ in_array($active ?? '', ['singalssubscriptions', 'subscribe-signals', 'my-subscriptions'], true) ? 'nav-link-active !border-b-0' : '' }}">
                    <span class="flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
</svg>
  Trading Signals</span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path></svg>
                </button>
                <div x-show="open" x-transition="" class="ml-8 space-y-0.5 mt-0.5" style="display: none;">
                    <a href="{{ url('/dashboard/singalssubscriptions') }}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">Signals</a>
                    <a href="{{ url('/dashboard/subscribe-signals') }}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">Signal Plans</a>
                    <a href="{{ url('/dashboard/my-subscriptions') }}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">My Subscriptions</a>
                </div>
            </div>
                                    <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full nav-link-item flex items-center justify-between ">
                    <span class="flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"></path>
</svg>
 NFT Market</span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path></svg>
                </button>
                <div x-show="open" x-transition="" class="ml-8 space-y-0.5 mt-0.5" style="display: none;">
                    <a href="{{ url('/dashboard/nft-gallery') }}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">Gallery</a>
                    <a href="{{ url('/dashboard/my-nfts') }}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">My Collection</a>
                    <a href="{{ url('/dashboard/nfts/create') }}" class="block py-1.5 px-3 text-sm rounded-lg text-content-tertiary hover:text-content-primary transition-colors">Mint NFT</a>
                </div>
            </div>

                        <p class="nav-group-label">Education</p>
            <a href="{{ url('/dashboard/courses') }}" class="nav-link-item {{ ($active ?? '') === 'courses' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"></path>
</svg>
 Courses
            </a>
            <a href="{{ url('/dashboard/my-courses') }}" class="nav-link-item {{ ($active ?? '') === 'my-courses' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"></path>
</svg>
 My Courses
            </a>

            <p class="nav-group-label">Account</p>
            <a href="{{ url('/dashboard/account-settings') }}" class="nav-link-item {{ ($active ?? '') === 'account-settings' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
</svg>
 Profile & Settings
            </a>
                        <a href="{{ url('/dashboard/referuser') }}" class="nav-link-item {{ ($active ?? '') === 'referuser' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path>
</svg>
 Referral Program
            </a>
            <a href="{{ url('/dashboard/news') }}" class="nav-link-item {{ ($active ?? '') === 'news' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"></path>
</svg>
 Market News
            </a>
            <a href="{{ url('/dashboard/support') }}" class="nav-link-item {{ ($active ?? '') === 'support' ? 'nav-link-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"></path>
</svg>
                <span class="flex-1">Support</span>
                            </a>
        </nav>

        <div class="border-t border-surface-border p-4 shrink-0">
            <form method="POST" action="{{ url('/logout') }}" id="sidebar-logout-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="nav-link-item !px-0 text-loss/80 hover:text-loss">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"></path>
</svg>
 Logout
            </a>
        </div>
    </aside>

    <header class="fixed top-0 right-0 z-30 h-16 bg-surface-raised border-b border-surface-border transition-all duration-200 lg:left-64 left-0">
        <div class="flex items-center justify-between h-full px-4 lg:px-6">

            <div class="flex items-center gap-3">
                <button @click="mobileSidebar = !mobileSidebar" class="lg:hidden text-content-tertiary hover:text-content-primary p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
</svg>
                </button>
                <h1 class="text-lg font-semibold text-content-primary hidden sm:block">{{ $headerTitle ?? 'Dashboard' }}</h1>
            </div>

            <div class="flex items-center gap-2">

                <div class="relative" x-data="{
                         notifs: [],
                         count: 0,
                         loaded: false,
                         loadNotifs() {
                             if (this.loaded) return;
                             fetch('{{ url('/dashboard/notifications/unread') }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                                 .then(r => r.json())
                                 .then(d => { this.notifs = d.notifications; this.count = d.count; this.loaded = true; })
                                 .catch(() => {});
                         },
                         markAllRead() {
                             fetch('{{ url('/dashboard/notifications/read-all') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' } })
                                 .then(() => { this.notifs = []; this.count = 0; });
                         }
                     }" @click.away="notifDropdown = false">
                    <button @click="notifDropdown = !notifDropdown; loadNotifs()" class="relative p-2 text-content-tertiary hover:text-content-primary rounded-lg hover:bg-surface-overlay transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"></path>
</svg>
                        <span x-show="count > 0" class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] flex items-center justify-center bg-loss text-white text-[10px] font-bold rounded-full px-1" x-text="count > 99 ? '99+' : count" style="display: none;">0</span>
                    </button>
                    <div x-show="notifDropdown" x-transition="" class="absolute right-0 mt-2 w-80 bg-surface-raised border border-surface-border rounded-xl shadow-xl z-50 overflow-hidden" style="display: none;">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-surface-border">
                            <h4 class="text-sm font-semibold text-content-primary">Notifications</h4>
                            <button x-show="count > 0" @click="markAllRead()" class="text-xs text-primary hover:text-primary-light transition-colors" style="display: none;">Mark all read</button>
                        </div>
                        <div class="max-h-72 overflow-y-auto divide-y divide-surface-border">
                            <template x-if="notifs.length === 0">
                                <p class="text-sm text-content-tertiary text-center py-6">No new notifications</p>
                            </template><p class="text-sm text-content-tertiary text-center py-6">No new notifications</p>
                            <template x-for="n in notifs" :key="n.id">
                                <a class="flex items-start gap-3 px-4 py-3 hover:bg-surface-overlay transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-primary-subtle flex items-center justify-center shrink-0 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"></path>
</svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-content-primary truncate" x-text="n.title"></p>
                                        <p class="text-xs text-content-tertiary mt-0.5 line-clamp-2" x-text="n.message"></p>
                                        <p class="text-[10px] text-content-tertiary mt-1" x-text="n.time"></p>
                                    </div>
                                </a>
                            </template>
                        </div>
                        <a href="{{ url('/dashboard/notification') }}" class="block text-center text-xs text-primary hover:text-primary-light py-3 border-t border-surface-border transition-colors">View all notifications</a>
                    </div>
                </div>

                <div class="relative" @click.away="userDropdown = false">
                    <button @click="userDropdown = !userDropdown" class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-surface-overlay transition-colors">
                            <div class="w-8 h-8 rounded-full bg-surface-overlay flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-content-tertiary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
</svg>
                            </div>
                        <span class="text-sm font-medium text-content-primary hidden md:block">{{ auth()->user()->name ?? 'Member' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-content-tertiary hidden md:block" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
</svg>
                    </button>
                    <div x-show="userDropdown" x-transition="" class="absolute right-0 mt-2 w-48 bg-surface-raised border border-surface-border rounded-xl shadow-xl py-1 z-50" style="display: none;">
                        <a href="{{ url('/dashboard/account-settings') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
</svg>
 Profile
                        </a>
                        <a href="{{ url('/dashboard/deposits') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
</svg>
 Deposit
                        </a>
                        <a href="{{ url('/dashboard/withdrawals') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"></path>
</svg>
 Withdraw
                        </a>
                        <a href="{{ url('/dashboard/accounthistory') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-content-secondary hover:bg-surface-overlay hover:text-content-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"></path>
</svg>
 Transactions
                        </a>
                        <div class="border-t border-surface-border my-1"></div>
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="flex items-center gap-2 px-4 py-2.5 text-sm text-loss/80 hover:bg-surface-overlay hover:text-loss transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"></path>
</svg>
 Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="transition-all duration-200 lg:ml-64 pt-16 min-h-screen">

        <nav class="flex overflow-x-auto border-b border-surface-border bg-surface-raised" aria-label="Main navigation">
            @php
                $navTabs = [
                    'Overview' => ['/dashboard', ['dashboard']],
                    'Trading' => ['/dashboard/trade', ['trade', 'positions', 'markets', 'tradinghistory']],
                    'Investments' => ['/dashboard/buy-plan', ['buy-plan']],
                    'Copy Trading' => ['/dashboard/copy-trading', ['copy-trading', 'expert']],
                    'Bot Trading' => ['/dashboard/bot-trading', ['bot-trading']],
                    'Pre-IPO' => ['/dashboard/pre-ipo', ['pre-ipo']],
                    'Stocks' => ['/dashboard/stocks', ['stocks']],
                    'NFTs' => ['/dashboard/nft-gallery', ['nft-gallery', 'my-nfts', 'nfts/create']],
                    'Loans' => ['/dashboard/loans/apply', ['loans/apply']],
                ];
                $currentNav = $active ?? 'dashboard';
            @endphp
            @foreach ($navTabs as $label => [$navHref, $navMarkers])
                <a href="{{ url('') }}{{ $navHref }}" aria-current="{{ in_array($currentNav, $navMarkers, true) ? 'page' : 'false' }}" class="tab-nav-link {{ in_array($currentNav, $navMarkers, true) ? 'tab-nav-link-active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        <div x-data="{ toasts: [] }" x-init="" class="fixed top-20 right-4 z-50 space-y-2 w-80">
            <template x-for="toast in toasts" :key="toast.id">
                <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0" :class="{
                        'bg-gain/10 border-gain/20 text-gain': toast.type === 'success',
                        'bg-loss/10 border-loss/20 text-loss': toast.type === 'error',
                        'bg-warning/10 border-warning/20 text-warning': toast.type === 'warning',
                     }" class="border rounded-lg p-4 flex items-start gap-3 shadow-lg backdrop-blur-sm">
                    <span x-text="toast.message" class="text-sm flex-1"></span>
                    <button @click="toasts = toasts.filter(t => t.id !== toast.id)" class="shrink-0 opacity-60 hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </template>
        </div>

        <div class="px-4 lg:px-6 py-6">
            @yield('content')
        </div>
    </main>

    <footer class="lg:ml-64 px-4 lg:px-6 py-6">
        <p class="text-content-tertiary text-xs">
            &copy; 2026 Runkavex Capital. All Rights Reserved.
        </p>
    </footer>

    <div x-data="{ open: false }" @open-mail-support.window="open = true" x-show="open" class="fixed inset-0 z-[60] flex items-center justify-center p-4" style="display: none;">
        <div x-show="open" x-transition.opacity="" class="absolute inset-0 bg-black/60" @click="open = false" style="display: none;"></div>
        <div x-show="open" x-transition="" class="relative w-full max-w-lg bg-surface-raised border border-surface-border rounded-2xl shadow-2xl overflow-hidden" style="display: none;">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-content-primary">Contact Support</h3>
                    <button @click="open = false" class="text-content-tertiary hover:text-content-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form method="POST" action="{{ url('') }}/dashboard/support" class="space-y-4">
                    @csrf
                    <input type="hidden" name="to_email" value="Runkavex Capital Support">
                    <input type="hidden" name="email" value="{{ auth()->user()->email ?? '' }}">
                    <input type="hidden" name="name" value="{{ auth()->user()->name ?? '' }}">
                    <input type="hidden" name="category" value="Contact Support">
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Subject</label>
                        <input type="text" name="subject" required placeholder="How can we help?" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="text-xs text-content-tertiary font-medium mb-1 block">Message</label>
                        <textarea name="message" rows="5" required placeholder="Describe your issue..." class="w-full bg-surface-overlay border border-surface-border rounded-lg px-3 py-2.5 text-sm text-content-primary placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="open = false" class="flex-1 bg-surface-overlay text-content-secondary hover:bg-surface-border rounded-lg py-2.5 text-sm font-medium transition-colors">Cancel</button>
                        <button type="submit" name="contact" class="flex-1 bg-primary hover:bg-primary-dark text-content-inverse rounded-lg py-2.5 text-sm font-medium transition-colors">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="gtranslate_wrapper"></div>
    <script>
        window.gtranslateSettings = {
            default_language: "en",
            alt_flags:{"en":"usa"},
            wrapper_selector: ".gtranslate_wrapper",
            flag_style: "3d",
        };
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
    @stack('scripts')
</body>
</html>
