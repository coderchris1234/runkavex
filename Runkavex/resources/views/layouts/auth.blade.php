<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Runkavex Capital - {{ $metaDesc ?? 'Account' }}">
    <title>{{ $pageTitle ?? 'Runkavex Capital' }}</title>

    <link rel="icon" href="{{ asset('brand/favicon.ico') }}" sizes="any">
    <link rel="icon" type="image/png" href="{{ asset('brand/icon.png') }}" />

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
        :root {
            --color-surface-base: #0B0B0B;
            --color-surface-raised: #1B1B1B;
            --color-surface-overlay: #232323;
            --color-surface-border: #2E2E2E;
            --color-surface-border-light: #3C3C3C;
            --color-content-primary: #F5F5F4;
            --color-content-secondary: #A1A1AA;
            --color-content-tertiary: #6B7280;
        }
        html { background-color: #0B0B0B; }
        body { font-family: 'Inter', system-ui, sans-serif; color: #A1A1AA; -webkit-font-smoothing: antialiased; }
        select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; -webkit-appearance: none; -moz-appearance: none; appearance: none; padding-right: 2.5rem; }
    }
    [x-cloak] { display: none !important; }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</head>
<body class="bg-surface-base min-h-screen flex flex-col">

    <main class="flex-1 flex items-center justify-center px-4 py-8">
        @yield('content')
    </main>

    <footer class="pb-6 px-4 text-center">
        <p class="text-content-tertiary text-xs">
            &copy; 2026 Runkavex Capital. All Rights Reserved.
        </p>
    </footer>

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

</body>
</html>
