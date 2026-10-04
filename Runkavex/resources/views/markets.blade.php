@extends('layouts.sub')
@section('content')

<section class="bg-body-bg py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="font-serif text-3xl md:text-4xl font-bold text-body-text">Available markets</h1>
            <p class="text-body-muted text-lg mt-4">Runkavex Capital offers access to several asset classes. Browse the categories below to see what you can trade on our platform.</p>
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-body-border p-6 hover:shadow-md transition group overflow-hidden">
                <div>
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background-color:#05966920">
                        <svg class="w-5 h-5" style="color:#059669" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h4 class="font-semibold text-body-text text-lg">Forex</h4>
                    <p class="text-body-muted text-sm mt-2 leading-relaxed">Trade major, minor and exotic currency pairs. Spreads and fees are published on your trading dashboard before you place an order.</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-body-border p-6 hover:shadow-md transition group overflow-hidden">
                <div>
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background-color:#2563EB20">
                        <svg class="w-5 h-5" style="color:#2563EB" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h4 class="font-semibold text-body-text text-lg">Stock CFDs</h4>
                    <p class="text-body-muted text-sm mt-2 leading-relaxed">Speculate on price movements of well-known stocks. You do not own the underlying shares — you trade on the price difference.</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-body-border p-6 hover:shadow-md transition group overflow-hidden">
                <div>
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background-color:#7C3AED20">
                        <svg class="w-5 h-5" style="color:#7C3AED" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h4 class="font-semibold text-body-text text-lg">Commodities</h4>
                    <p class="text-body-muted text-sm mt-2 leading-relaxed">Trade CFDs on gold, silver, oil and other commodities. Prices are sourced from market data providers.</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-body-border p-6 hover:shadow-md transition group overflow-hidden">
                <div>
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background-color:#0284C720">
                        <svg class="w-5 h-5" style="color:#0284C7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h4 class="font-semibold text-body-text text-lg">Indices</h4>
                    <p class="text-body-muted text-sm mt-2 leading-relaxed">Access CFDs on popular stock indices. Track the broader market direction without trading individual stocks.</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-body-border p-6 hover:shadow-md transition group overflow-hidden">
                <div>
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background-color:#6B728020">
                        <svg class="w-5 h-5" style="color:#6B7280" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h4 class="font-semibold text-body-text text-lg">Cryptocurrency</h4>
                    <p class="text-body-muted text-sm mt-2 leading-relaxed">Trade Bitcoin, Ethereum and other digital currencies. Crypto markets can be highly volatile — trade responsibly.</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-body-border p-6 hover:shadow-md transition group overflow-hidden">
                <div>
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background-color:#D9770620">
                        <svg class="w-5 h-5" style="color:#D97706" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h4 class="font-semibold text-body-text text-lg">ETFs & Bonds</h4>
                    <p class="text-body-muted text-sm mt-2 leading-relaxed">Diversify your portfolio with exchange-traded funds and government bond CFDs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-body-bg py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="font-serif text-3xl font-bold text-body-text">Platform features</h2>
                <p class="text-body-muted mt-4 leading-relaxed">Our web-based platform is designed to be simple and transparent. Here is what you can expect when you trade with Runkavex Capital.</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-body-muted text-sm ml-2">Published spreads — visible before you place a trade</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-body-muted text-sm ml-2">Real-time charts and market data</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-body-muted text-sm ml-2">Stop-loss and take-profit order types</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-body-muted text-sm ml-2">Segregated client accounts</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-body-muted text-sm ml-2">Two-factor authentication (2FA)</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-body-muted text-sm ml-2">Withdrawal requests processed within 24 hours</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-body-muted text-sm ml-2">Multiple deposit methods accepted</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-body-muted text-sm ml-2">Responsive support via email and live chat</span>
                    </li>
                </ul>
            </div>
            <div class="rounded-xl overflow-hidden shadow-sm border border-body-border">
                <img src="{{ asset('temp/frontpage/img/in-cirro-7-map.svg') }}" alt="Global Markets" class="w-full" />
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <h2 class="font-serif text-3xl font-bold text-body-text">Example instruments</h2>
            <p class="text-body-muted mt-2">A selection of the instruments available on our platform. This is not an exhaustive list.</p>
        </div>
        <div class="bg-white rounded-xl border border-body-border shadow-sm overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-surface-base text-white">
                        <th class="text-left py-3 px-4 font-semibold">Instrument</th>
                        <th class="text-center py-3 px-4 font-semibold">Category</th>
                        <th class="text-center py-3 px-4 font-semibold">Type</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-body-border">
                    <tr class="hover:bg-body-bg/50 transition">
                        <td class="py-3 px-4 font-semibold text-body-text">EUR/USD</td>
                        <td class="py-3 px-4 text-center"><span class="bg-primary-subtle text-primary text-xs px-2 py-0.5 rounded font-medium">Forex</span></td>
                        <td class="py-3 px-4 text-center text-body-muted">Currency Pair</td>
                    </tr>
                    <tr class="hover:bg-body-bg/50 transition">
                        <td class="py-3 px-4 font-semibold text-body-text">BTC/USD</td>
                        <td class="py-3 px-4 text-center"><span class="bg-primary-subtle text-primary text-xs px-2 py-0.5 rounded font-medium">Crypto</span></td>
                        <td class="py-3 px-4 text-center text-body-muted">Cryptocurrency</td>
                    </tr>
                    <tr class="hover:bg-body-bg/50 transition">
                        <td class="py-3 px-4 font-semibold text-body-text">Gold (XAU)</td>
                        <td class="py-3 px-4 text-center"><span class="bg-primary-subtle text-primary text-xs px-2 py-0.5 rounded font-medium">Commodity</span></td>
                        <td class="py-3 px-4 text-center text-body-muted">Precious Metal</td>
                    </tr>
                    <tr class="hover:bg-body-bg/50 transition">
                        <td class="py-3 px-4 font-semibold text-body-text">S&P 500</td>
                        <td class="py-3 px-4 text-center"><span class="bg-primary-subtle text-primary text-xs px-2 py-0.5 rounded font-medium">Index</span></td>
                        <td class="py-3 px-4 text-center text-body-muted">Stock Index CFD</td>
                    </tr>
                    <tr class="hover:bg-body-bg/50 transition">
                        <td class="py-3 px-4 font-semibold text-body-text">Apple (AAPL)</td>
                        <td class="py-3 px-4 text-center"><span class="bg-primary-subtle text-primary text-xs px-2 py-0.5 rounded font-medium">Stock CFD</span></td>
                        <td class="py-3 px-4 text-center text-body-muted">Equity</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-body-muted text-xs mt-4 text-center">Trading CFDs involves risk. You may lose more than your initial deposit. Please read our <a href="{{ url('/risk') }}" class="text-primary hover:underline">risk disclosure</a>.</p>
    </div>
</section>

<section class="bg-primary py-16">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="font-serif text-3xl md:text-4xl font-bold text-white">Ready to explore the markets?</h2>
        <p class="text-white/80 mt-3 text-lg">Open an account with Runkavex Capital and start trading.</p>
        <a href="{{ url('/register') }}" class="inline-block mt-6 bg-white text-primary font-semibold rounded-lg px-8 py-3 hover:bg-gray-100 transition shadow-lg">
            Open an Account
        </a>
    </div>
</section>

@endsection
