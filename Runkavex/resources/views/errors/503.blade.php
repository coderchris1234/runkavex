<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#16C79A" />
    <title>Runkavex Capital | Under Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                colors: {
                    surface: { base: '#0B0B0B', raised: '#1B1B1B', overlay: '#232323', border: '#2E2E2E' },
                    content: { primary: '#F5F5F4', secondary: '#A1A1AA', tertiary: '#6B7280', inverse: '#0B0B0B' },
                    primary: { DEFAULT: '#16C79A', dark: '#0E9E78' },
                },
            },
        },
    }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-surface-base font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" class="h-10 mb-8">
        <div class="w-16 h-16 rounded-2xl bg-primary/10 border border-primary/20 flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/></svg>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-content-primary text-center">We'll be right back</h1>
        <p class="text-content-secondary text-center mt-4 max-w-md leading-relaxed">Runkavex Capital is currently undergoing scheduled maintenance. Trading will be available again shortly. Thank you for your patience.</p>
        <div class="flex items-center gap-3 mt-8">
            <div class="flex items-center gap-2 text-sm text-content-tertiary">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span> Service temporarily unavailable
            </div>
        </div>
    </div>
</body>
</html>