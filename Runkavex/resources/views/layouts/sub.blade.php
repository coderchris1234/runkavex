<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Runkavex Capital - Unlock the Power of Your Finance" />
    <meta property="og:image" content="{{ asset('brand/logo.png') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta name="theme-color" content="#16C79A" />
    <link rel="shortcut icon" href="{{ asset('brand/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" href="{{ asset('brand/icon.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('brand/icon_128.png') }}" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Poppins', 'system-ui', 'sans-serif'],
                    serif: ['Merriweather', 'Georgia', 'serif'],
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
                    body: {
                        bg: '#F5F7F9',
                        text: '#1F2937',
                        muted: '#6B7280',
                        border: '#E5E7EB',
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.14.8/dist/cdn.min.js"></script>

    <title>{{ $pageTitle ?? 'Runkavex Capital' }}</title>

    <style>
        iframe.goog-te-banner-frame, iframe.skiptranslate { display: none !important; }
        body { position: static !important; top: 0px !important; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased bg-body-bg text-body-text">
    <div id="page-loader" class="fixed inset-0 z-[9999] bg-white flex items-center justify-center">
        <div class="flex space-x-1.5">
            <div class="w-2.5 h-2.5 bg-primary rounded-full animate-bounce" style="animation-delay: 0ms"></div>
            <div class="w-2.5 h-2.5 bg-primary rounded-full animate-bounce" style="animation-delay: 150ms"></div>
            <div class="w-2.5 h-2.5 bg-primary rounded-full animate-bounce" style="animation-delay: 300ms"></div>
        </div>
    </div>

    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 bg-surface-base border-b border-surface-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex-shrink-0">
                    <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" class="h-10 w-auto" />
                </a>

                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="{{ url('/') }}" class="px-3 py-2 text-sm font-medium text-content-secondary hover:text-content-primary transition">Home</a>
                    <a href="{{ url('/about') }}" class="px-3 py-2 text-sm font-medium text-content-secondary hover:text-content-primary transition">About Us</a>
                    <a href="{{ url('/careers') }}" class="px-3 py-2 text-sm font-medium text-content-secondary hover:text-content-primary transition">Services</a>
                    <a href="{{ url('/markets') }}" class="px-3 py-2 text-sm font-medium text-content-secondary hover:text-content-primary transition">Investment Options</a>

                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button @click="open = !open" class="inline-flex items-center px-3 py-2 text-sm font-medium text-content-secondary hover:text-content-primary transition">
                            Resources
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-1 w-64 bg-surface-raised rounded-lg shadow-xl border border-surface-border py-2" x-cloak>
                            <a href="{{ url('/legal-docs') }}" class="block px-4 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay transition">
                                Legal Docs
                                <svg class="inline w-4 h-4 ml-1 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </a>
                            <a href="{{ url('/news') }}" class="block px-4 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay transition">
                                News &amp; Insights
                                <svg class="inline w-4 h-4 ml-1 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </a>
                            <a href="{{ url('/contact') }}" class="block px-4 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay transition">Help Center</a>
                        </div>
                    </div>
                </nav>

                <div class="hidden lg:flex items-center space-x-3">
                    <a href="{{ url('/login') }}" class="text-sm text-content-secondary hover:text-content-primary transition">
                        <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Login
                    </a>
                    <a href="{{ url('/register') }}" class="bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg px-5 py-2.5 text-sm transition">Get Started</a>
                </div>

                <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-content-secondary hover:text-content-primary p-2">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden border-t border-surface-border pb-4" x-cloak>
                <div class="pt-3 space-y-1">
                    <a href="{{ url('/') }}" class="block px-3 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay rounded-lg transition">Home</a>
                    <a href="{{ url('/about') }}" class="block px-3 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay rounded-lg transition">About Us</a>
                    <a href="{{ url('/careers') }}" class="block px-3 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay rounded-lg transition">Services</a>
                    <a href="{{ url('/markets') }}" class="block px-3 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay rounded-lg transition">Investment Options</a>
                    <a href="{{ url('/legal-docs') }}" class="block px-3 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay rounded-lg transition">FAQs</a>
                    <a href="{{ url('/contact') }}" class="block px-3 py-2 text-sm text-content-secondary hover:text-content-primary hover:bg-surface-overlay rounded-lg transition">Contact Us</a>
                </div>
                <div class="pt-4 px-3 space-y-2 border-t border-surface-border mt-3">
                    <a href="{{ url('/login') }}" class="block w-full text-center text-sm text-content-secondary hover:text-content-primary py-2 transition">Login</a>
                    <a href="{{ url('/register') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg px-5 py-2.5 text-sm transition">Get Started</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-surface-base border-t border-surface-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-1">
                    <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" class="h-10 w-auto mb-4" />
                    <a href="mailto:support@runkavexcapital.com" class="text-content-secondary hover:text-primary-light text-sm transition">
                        support@runkavexcapital.com
                    </a>
                </div>

                <div>
                    <h4 class="text-content-primary font-semibold text-sm uppercase tracking-wider mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-content-secondary hover:text-primary-light text-sm transition">Home</a></li>
                        <li><a href="{{ url('/about') }}" class="text-content-secondary hover:text-primary-light text-sm transition">About Us</a></li>
                        <li><a href="{{ url('/careers') }}" class="text-content-secondary hover:text-primary-light text-sm transition">Our Services</a></li>
                        <li><a href="{{ url('/markets') }}" class="text-content-secondary hover:text-primary-light text-sm transition">Investment Options</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-content-primary font-semibold text-sm uppercase tracking-wider mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/legal-docs') }}" class="text-content-secondary hover:text-primary-light text-sm transition">FAQs</a></li>
                        <li><a href="mailto:support@runkavexcapital.com" class="text-content-secondary hover:text-primary-light text-sm transition">Contact Us</a></li>
                        <li><a href="{{ url('/legal-docs') }}" class="text-content-secondary hover:text-primary-light text-sm transition">Legal Docs</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-surface-border mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between">
                <p class="text-content-tertiary text-xs">
                    &copy; 2026 Runkavex Capital. All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <div x-data="{ show: false }" @scroll.window="show = window.scrollY > 400" class="hidden md:block">
        <button x-show="show" @click="window.scrollTo({ top: 0, behavior: 'smooth' })" x-transition
            class="fixed bottom-6 right-6 z-40 bg-primary hover:bg-primary-dark text-white rounded-full p-3 shadow-lg transition"
            aria-label="Back to top">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
        </button>
    </div>

    <script>
        setTimeout(function() {
            var loader = document.getElementById('page-loader');
            if (loader) loader.style.display = 'none';
        }, 800);
    </script>

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
