@php $active = 'connect-wallet'; $headerTitle = 'Connect Wallet'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Connect Wallet')

@section('content')

<div class="p-4 lg:p-6 space-y-6" x-data="{ network: 'solana', networkLabel: 'Solana', address: window.wallets ? window.wallets['solana'] : '', revealed: false, copied: false }">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-surface-raised border border-surface-border rounded-xl p-5 sm:p-6">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-12 h-12 rounded-xl bg-primary-subtle flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3"></path>
</svg>
                </div>
                <div>
                    <h1 class="text-lg font-semibold text-content-primary">Wallet Deposit Address</h1>
                    <p class="text-sm text-content-tertiary">Select a network to view your deposit gateway</p>
                </div>
            </div>

            <div class="bg-surface-overlay/40 border border-surface-border rounded-xl p-5">
                <h3 class="text-sm font-semibold text-content-primary mb-2">Generate a New Address</h3>
                <p class="text-xs text-content-tertiary mb-4">Select a supported network to reveal its deposit address. Always verify the network before sending funds.</p>

                <div class="flex flex-col gap-3">
                    <select x-model="network" @change="networkLabel = $event.target.options[$event.target.selectedIndex].text.replace(/\s*\(.*\)/, ''); address = window.wallets[network]; revealed = false; copied = false" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <option value="solana">Solana (SOL)</option>
                        <option value="ethereum">Ethereum (ETH)</option>
                        <option value="bitcoin_taproot">Bitcoin Taproot (BTC)</option>
                        <option value="bitcoin_segwit">Bitcoin Native SegWit (BTC)</option>
                        <option value="robinhood">Robinhood (ROBIN)</option>
                        <option value="base">Base (BASE)</option>
                        <option value="sui">Sui (SUI)</option>
                        <option value="polygon">Polygon (MATIC)</option>
                        <option value="hyper_evm">HyperEVM (HYPE)</option>
                    </select>
                    <button type="button" @click="address = window.wallets[network]; revealed = true" class="bg-primary hover:bg-primary-dark text-content-inverse font-semibold text-sm py-2.5 px-5 rounded-lg transition-colors">
                        Generate
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-surface-raised border border-surface-border rounded-xl p-5 sm:p-6" x-show="revealed" x-cloak>
            <div class="text-center mb-4">
                <template x-if="address">
                    <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=180x180&margin=0&data=' + encodeURIComponent(address)" alt="QR Code" class="w-44 h-44 mx-auto rounded-lg border border-surface-border bg-white p-2">
                </template>
                <h3 class="text-lg font-semibold text-content-primary mt-3" x-show="revealed">
                    Deposit Address <span class="text-sm text-content-tertiary">(<span x-text="networkLabel"></span>)</span>
                </h3>
            </div>

            <template x-if="address">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <input type="text" readonly :value="address" class="flex-1 w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-xs text-content-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <button type="button" @click="navigator.clipboard.writeText(address); copied = true; setTimeout(() => copied = false, 2000)" class="shrink-0 px-4 py-2.5 rounded-lg bg-surface-overlay hover:bg-surface-border border border-surface-border text-content-primary text-sm font-medium transition-colors" x-text="copied ? 'Copied' : 'Copy'">
                            Copy
                        </button>
                    </div>
                    <p class="text-xs text-warning">Only send on the <span x-text="networkLabel"></span> network, and only send a coin that runs on this network.</p>
                </div>
            </template>

            <div x-show="!revealed" class="text-center py-10 text-content-tertiary">
                <p class="text-sm">Generate an address to see the deposit gateway.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
window.wallets = @json($wallets);
</script>
@endpush
