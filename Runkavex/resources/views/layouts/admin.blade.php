<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Runkavex Capital - Admin Panel">
    <title>{{ $pageTitle ?? 'Admin Panel | Runkavex Capital' }}</title>

    <link rel="icon" href="{{ asset('brand/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('brand/icon.png') }}" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: { sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'] },
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
        html { background-color: #0B0B0B; }
        body { font-family: 'Inter', system-ui, sans-serif; color: #A1A1AA; -webkit-font-smoothing: antialiased; }
        select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; -webkit-appearance: none; -moz-appearance: none; appearance: none; padding-right: 2.5rem; }
    }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</head>
<body class="bg-surface-base" x-data="{ sidebarOpen: true, toasts: [] }" x-init="window._pushToast = (msg, type='success') => { toasts.push({ msg, type, id: Date.now() }); setTimeout(() => toasts.splice(0, 1), 4500); }">

    @php
        $adminNav = [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin.dashboard')],
            ['label' => 'Users', 'route' => 'admin.users', 'active' => request()->routeIs('admin.users', 'admin.users.show')],
            ['label' => 'Transactions', 'route' => 'admin.transactions', 'active' => request()->routeIs('admin.transactions')],
            ['label' => 'Deposits', 'route' => 'admin.deposits', 'active' => request()->routeIs('admin.deposits')],
            ['label' => 'Withdrawals', 'route' => 'admin.withdrawals', 'active' => request()->routeIs('admin.withdrawals')],
            ['label' => 'Trades', 'route' => 'admin.trades', 'active' => request()->routeIs('admin.trades', 'admin.trades.show', 'admin.trades.create')],
            ['label' => 'Markets', 'route' => 'admin.markets', 'active' => request()->routeIs('admin.markets')],
            ['label' => 'Loans', 'route' => 'admin.loans', 'active' => request()->routeIs('admin.loans')],
            ['label' => 'Loan Products', 'route' => 'admin.loan-plans', 'active' => request()->routeIs('admin.loan-plans')],
            ['label' => 'Investments', 'route' => 'admin.investments', 'active' => request()->routeIs('admin.investments')],
            ['label' => 'Support', 'route' => 'admin.support', 'active' => request()->routeIs('admin.support', 'admin.support.show')],
            ['label' => 'Notifications', 'route' => 'admin.notifications', 'active' => request()->routeIs('admin.notifications')],
            ['label' => 'Referrals', 'route' => 'admin.referrals', 'active' => request()->routeIs('admin.referrals', 'admin.referrals.tree')],
            ['label' => 'Signal Subscriptions', 'route' => 'admin.signals', 'active' => request()->routeIs('admin.signals', 'admin.signal-plans')],
            ['label' => 'Investment Plans', 'route' => 'admin.plans', 'active' => request()->routeIs('admin.plans')],
            ['label' => 'Reports', 'route' => 'admin.reports', 'active' => request()->routeIs('admin.reports')],
            ['label' => 'Audit Log', 'route' => 'admin.audit', 'active' => request()->routeIs('admin.audit')],
            ['label' => 'Content Editor', 'route' => 'admin.cms', 'active' => request()->routeIs('admin.cms')],
            ['label' => 'Articles', 'route' => 'admin.articles', 'active' => request()->routeIs('admin.articles')],
            ['label' => 'Settings', 'route' => 'admin.settings', 'active' => request()->routeIs('admin.settings')],
        ];
    @endphp

    <div class="flex h-screen overflow-hidden">
        <aside :class="sidebarOpen ? 'w-64' : 'w-0'" class="hidden md:flex md:flex-col shrink-0 border-r border-surface-border bg-surface-raised transition-all duration-300 overflow-hidden">
            <div class="flex items-center gap-2 px-5 h-16 border-b border-surface-border shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" class="h-8">
                </a>
                <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-content-inverse bg-primary rounded">Admin</span>
            </div>
            <nav class="flex-1 overflow-y-auto min-h-0 p-3 space-y-1 admin-sidebar-scroll">
                @foreach($adminNav as $nav)
                    <a href="{{ route($nav['route']) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ $nav['active'] ? 'bg-primary text-content-inverse' : 'text-content-secondary hover:bg-surface-overlay hover:text-content-primary' }}">
                        {{ $nav['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        <div class="flex-1 min-w-0 min-h-0 flex flex-col">
            <header class="h-16 shrink-0 border-b border-surface-border bg-surface-raised flex items-center justify-between px-4 lg:px-6">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-lg bg-surface-overlay text-content-secondary hover:text-content-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
</svg>
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-content-primary">Runkavex Capital Admin</a>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="text-sm text-content-secondary hover:text-content-primary transition-colors">View Site</a>
                    <span class="hidden sm:inline text-sm text-content-secondary">{{ Auth::guard('admin')->user()?->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 text-xs font-medium rounded-lg bg-surface-overlay border border-surface-border text-content-secondary hover:text-loss hover:border-loss/40 transition-colors">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto min-h-0 p-4 lg:p-6">
                @if(session('success'))
                    <div class="mb-4 flex items-center gap-3 border border-gain/20 bg-gain/10 text-gain rounded-lg px-4 py-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="m9 12.75 3 3L20.25 6.75M4.5 12.75a7.5 7.5 0 1 0 15 0 7.5 7.5 0 0 0-15 0Z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 flex items-center gap-3 border border-loss/20 bg-loss/10 text-loss rounded-lg px-4 py-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-4 flex items-center gap-3 border border-loss/20 bg-loss/10 text-loss rounded-lg px-4 py-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path></svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <div class="fixed bottom-4 right-4 space-y-2 z-50" x-cloak>
        <template x-for="t in toasts" :key="t.id">
            <div x-show="toasts.includes(t)" x-transition class="px-4 py-3 rounded-lg shadow-lg text-sm font-medium border"
                :class="t.type === 'error' ? 'bg-loss/10 border-loss/30 text-loss' : 'bg-gain/10 border-gain/30 text-gain'">
                <span x-text="t.msg"></span>
            </div>
        </template>
    </div>
    <style>[x-cloak] { display: none !important; }
    .admin-sidebar-scroll { scrollbar-width: thin; scrollbar-color: #3C3C3C transparent; }
    .admin-sidebar-scroll::-webkit-scrollbar { width: 6px; }
    .admin-sidebar-scroll::-webkit-scrollbar-thumb { background-color: #3C3C3C; border-radius: 3px; }
    .admin-sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
    </style>
</body>
</html>