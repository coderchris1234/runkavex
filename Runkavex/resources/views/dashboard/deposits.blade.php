@php $active = 'deposits'; $headerTitle = 'Fund your account'; @endphp

@extends('layouts.dashboard')

@section('pageTitle', 'Fund your account')

@push('head')
<script src="{{ asset('js/deposit-wallet.js') }}" defer></script>
@endpush

@section('content')

<div class="p-4 lg:p-6 space-y-6" x-data="depositSheet()">

    @if(session('success'))
        <div class="flex items-center gap-3 border border-gain/20 bg-gain/10 text-gain rounded-lg px-4 py-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="m9 12.75 3 3L20.25 6.75M4.5 12.75a7.5 7.5 0 1 0 15 0 7.5 7.5 0 0 0-15 0Z"></path>
</svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="flex items-center gap-3 border border-loss/20 bg-loss/10 text-loss rounded-lg px-4 py-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
</svg>
            <div>
                <span>{{ $errors->first() }}</span>
            </div>
        </div>
    @endif

    <div class="mb-6">
        <h2 class="text-xl font-bold text-content-primary">Deposit Funds</h2>
        <p class="text-sm text-content-secondary mt-1">Select a network to see the deposit address for your wallet</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
            <div class="px-5 py-4 border-b border-surface-border">
                <h3 class="text-base font-semibold text-content-primary">Deposit Methods</h3>
            </div>
            <div class="divide-y divide-surface-border">
                @php
                    $methods = [
                        ['solana', 'Solana', 'SOL', 'https://assets.coingecko.com/coins/images/4128/standard/solana.png?1718769756', null],
                        ['ethereum', 'Ethereum', 'ETH', 'https://assets.coingecko.com/coins/images/279/standard/ethereum.png?1696501628', null],
                        ['bitcoin_taproot', 'Bitcoin (Taproot)', 'BTC', 'https://assets.coingecko.com/coins/images/1/standard/bitcoin.png?1696501400', null],
                        ['bitcoin_segwit', 'Bitcoin (Native SegWit)', 'BTC', 'https://assets.coingecko.com/coins/images/1/standard/bitcoin.png?1696501400', null],
                        ['robinhood', 'Robinhood', 'ROBIN', 'https://s2.coinmarketcap.com/static/img/coins/64x64/3986.png', null],
                        ['base', 'Base', 'BASE', 'https://s2.coinmarketcap.com/static/img/coins/64x64/27716.png', null],
                        ['sui', 'Sui', 'SUI', 'https://assets.coingecko.com/coins/images/26375/standard/sui_asset.jpeg?1696520600', null],
                        ['polygon', 'Polygon', 'MATIC', 'https://assets.coingecko.com/coins/images/4713/standard/matic-token-icon.png?1696530626', null],
                        ['hyper_evm', 'HyperEVM', 'HYPE', 'https://s2.coinmarketcap.com/static/img/coins/64x64/31256.png', null],
                    ];
                @endphp
                @foreach($methods as [$key, $name, $code, $icon, $badge])
                    <div class="p-5 hover:bg-surface-overlay/50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                @if($icon)
                                    <img src="{{ $icon }}" alt="{{ $name }}" class="w-10 h-10 rounded-lg object-contain bg-surface-overlay p-1">
                                @else
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-sm font-bold {{ $badge }}">{{ $code }}</div>
                                @endif
                                <div>
                                    <h4 class="text-sm font-semibold text-content-primary mb-1">{{ $name }} <span class="text-xs text-content-tertiary">({{ $code }})</span></h4>
                                    <p class="text-xs text-primary">View deposit address</p>
                                </div>
                            </div>
                            <button @click="network = '{{ $key }}'; networkLabel = '{{ $name }}'; open = true; errorMessage = ''; status = 'idle'; txHash = ''; transferAmount = ''; syncProvider(); checkNetwork(); restoreConnection(); refreshWalletDetails(); mode = canSendFromWallet ? 'wallet' : 'manual';" class="bg-primary hover:bg-primary-dark text-content-inverse px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Deposit
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
                <div class="px-5 py-4 border-b border-surface-border">
                    <h3 class="text-base font-semibold text-content-primary">Deposit History</h3>
                </div>
                @if($deposits->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-xs uppercase tracking-wider text-content-tertiary border-b border-surface-border">
                                    <th class="px-5 py-3 font-medium">Date</th>
                                    <th class="px-5 py-3 font-medium">Method</th>
                                    <th class="px-5 py-3 font-medium">Amount</th>
                                    <th class="px-5 py-3 font-medium">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-border">
                                @foreach($deposits as $deposit)
                                    <tr>
                                        <td class="px-5 py-3 text-content-secondary">{{ $deposit->created_at->format('M d, Y') }}</td>
                                        <td class="px-5 py-3">
                                            <span class="text-content-primary font-medium">{{ $deposit->method }}</span>
                                            @if($deposit->network)
                                                <span class="block text-xs text-content-tertiary capitalize">{{ str_replace('_', ' ', $deposit->network) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3 text-content-primary font-semibold">${{ number_format($deposit->amount, 2) }}</td>
                                        <td class="px-5 py-3">
                                            @if($deposit->status === 'approved')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gain/10 text-gain">Completed</span>
                                            @elseif($deposit->status === 'pending')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-warning/10 text-warning">Pending</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-loss/10 text-loss">{{ ucfirst($deposit->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-5 py-10 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-content-tertiary mx-auto mb-2" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"></path>
</svg>
                        <p class="text-xs text-content-tertiary">No deposits yet</p>
                    </div>
                @endif
            </div>

            <div class="bg-surface-raised border border-surface-border rounded-xl overflow-hidden">
                <div class="px-5 py-4 border-b border-surface-border flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                    <h3 class="text-base font-semibold text-content-primary">Need help?</h3>
                </div>
                <div class="p-5">
                    <p class="text-sm text-content-secondary leading-relaxed mb-3">
                        Having trouble with your deposit? Contact our support team and we'll assist you.
                    </p>
                    <a href="mailto:support@runkavexcapital.com" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-content-inverse px-4 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        support@runkavexcapital.com
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div x-show="open" class="fixed inset-0 z-50 flex items-end justify-center bg-black/60" style="display:none;" @keydown.escape.window="closeSheet()">
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full"
            class="w-full max-w-md bg-surface-raised border border-surface-border rounded-t-2xl p-6 max-h-[90vh] overflow-y-auto" @click.outside="closeSheet()">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-semibold text-content-primary">Deposit via <span x-text="networkLabel"></span></h3>
                <button @click="open = false" class="text-content-tertiary hover:text-content-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
</svg>
                </button>
            </div>

            <div class="grid grid-cols-2 gap-2 mb-5">
                <button type="button" @click="mode = 'manual'"
                    class="py-2.5 rounded-lg text-sm font-semibold transition-colors"
                    :class="mode === 'manual' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary'">
                    Deposit Funds
                </button>
                <button type="button" @click="mode = 'wallet'"
                    class="py-2.5 rounded-lg text-sm font-semibold transition-colors"
                    :class="mode === 'wallet' ? 'bg-primary text-content-inverse' : 'bg-surface-overlay text-content-secondary hover:bg-surface-border hover:text-content-primary'">
                    Connect &amp; Transfer
                </button>
            </div>

            <div x-show="mode === 'manual'">

            <div class="text-center mb-5">
                <template x-if="window.wallets && window.wallets[network]">
                    <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=180x180&margin=0&data=' + encodeURIComponent(window.wallets[network])" alt="QR Code" class="w-44 h-44 mx-auto rounded-lg border border-surface-border bg-white p-2">
                </template>
                <p class="text-xs text-content-tertiary mt-3 leading-relaxed">
                    Send the amount to the address below, then submit your transaction hash and proof of payment. Your deposit will be credited once our team has reviewed and confirmed the transaction on-chain.
                </p>
            </div>

            <template x-if="window.wallets && window.wallets[network]">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Deposit Address (<span x-text="networkLabel"></span>)</label>
                    <div class="flex items-center gap-2">
                        <input type="text" readonly :value="window.wallets[network]" class="flex-1 w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-xs text-content-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <button type="button" @click="navigator.clipboard.writeText(window.wallets[network]); copied = network; setTimeout(() => copied = null, 2000)" class="shrink-0 px-4 py-2.5 rounded-lg bg-surface-overlay hover:bg-surface-border border border-surface-border text-content-primary text-sm font-medium transition-colors" x-text="copied === network ? 'Copied' : 'Copy'">
                            Copy
                        </button>
                    </div>
                    <p class="text-xs text-warning mt-2">Only send on the <span x-text="networkLabel"></span> network, and only send a coin that runs on this network.</p>
                </div>
            </template>

            <form method="POST" action="{{ url('/dashboard/deposits') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="method" :value="networkLabel">
                <input type="hidden" name="network" :value="network">
                <input type="hidden" name="source" :value="txHash ? 'wallet' : 'manual'">
                <input type="hidden" name="sender_address" :value="address || ''">

                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Amount ($)</label>
                    <input type="number" name="amount" min="1" step="0.01" x-model="amount" required placeholder="0.00"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Transaction Hash</label>
                    <input type="text" name="tx_hash" placeholder="Paste your transaction hash" class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Proof of Payment</label>
                    <input type="file" name="proof" accept="image/*" class="w-full text-sm text-content-secondary file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-surface-overlay file:text-content-primary file:text-sm file:font-medium hover:file:bg-surface-border cursor-pointer">
                </div>

                <div class="flex gap-3 pt-1">
                    <button type="button" @click="closeSheet()" class="flex-1 py-2.5 rounded-lg bg-surface-overlay hover:bg-surface-border text-content-primary text-sm font-medium transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors">
                        Submit Deposit
                    </button>
                </div>
            </form>

            </div>

            <div x-show="mode === 'wallet'" class="border-t border-surface-border pt-5" x-cloak>
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                    <h4 class="text-sm font-semibold text-content-primary">Connect &amp; Transfer</h4>
                </div>
                <p class="text-xs text-content-tertiary mb-4 leading-relaxed">Connect a wallet to send funds straight from your own wallet. Your wallet will ask you to approve the transfer.</p>

                <template x-if="!hasWalletSupport">
                    <div class="border border-surface-border bg-surface-overlay/40 rounded-lg p-4">
                        <p class="text-xs text-content-tertiary leading-relaxed">
                            No browser wallet can send <span class="text-content-secondary font-medium" x-text="networkLabel"></span> directly. Use the deposit address and submit your transaction hash manually.
                        </p>
                    </div>
                </template>

                <template x-if="hasWalletSupport && !connected && compatibleWallets.length > 0">
                    <div class="space-y-2">
                        <p class="text-xs text-content-tertiary">
                            <span x-text="compatibleWallets.length"></span>
                            <span x-text="compatibleWallets.length === 1 ? 'wallet' : 'wallets'"></span>
                            detected on this device. Choose the one you want to use:
                        </p>
                        <template x-for="wallet in compatibleWallets" :key="wallet.id">
                            <div class="flex items-center gap-3 border border-surface-border bg-surface-overlay/40 rounded-lg p-3">
                                <span class="text-xl" x-text="wallet.icon"></span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-content-primary" x-text="wallet.label"></p>
                                    <p class="text-xs text-content-tertiary" x-text="wallet.kind === 'evm' ? 'EVM networks' : kindLabel(wallet.kind)"></p>
                                </div>
                                <button type="button" @click="connect(wallet)" :disabled="connecting"
                                    class="shrink-0 px-4 py-2 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors disabled:opacity-60">
                                    <span x-show="connectingId !== wallet.id">Connect</span>
                                    <span x-show="connectingId === wallet.id" x-cloak>Connecting…</span>
                                </button>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-if="hasWalletSupport && !connected && compatibleWallets.length === 0">
                    <div class="space-y-2">
                        <p class="text-xs text-content-tertiary">
                            No <span x-text="kindLabel(providerKind)"></span> wallet detected. Install one of these, then reload this page:
                        </p>
                        <div class="grid grid-cols-2 gap-2">
                            <template x-for="link in linksForNetwork()" :key="link.name">
                                <a :href="link.scheme" class="flex items-center justify-center gap-2 py-2.5 rounded-lg bg-surface-overlay hover:bg-surface-border border border-surface-border text-content-primary text-sm font-medium transition-colors">
                                    <span x-text="link.icon"></span>
                                    <span x-text="link.name"></span>
                                </a>
                            </template>
                        </div>
                        <p x-show="isEvm" class="text-xs text-content-tertiary pt-1">On desktop, install any EVM wallet from your browser's extension store, then reload.</p>
                    </div>
                </template>

                <template x-if="hasWalletSupport && connected">
                    <div class="space-y-4">
                        <div class="border border-surface-border bg-surface-overlay/40 rounded-lg p-4">
                            <div class="flex items-center gap-3">
                                <span class="text-xl" x-text="providerInfo?.icon"></span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-content-primary" x-text="providerInfo?.label"></p>
                                    <p class="text-xs text-content-tertiary font-mono truncate" x-text="shortAddress" :title="address"></p>
                                </div>
                                <button type="button" @click="disconnect()" class="shrink-0 text-xs text-content-tertiary hover:text-loss transition-colors">Disconnect</button>
                            </div>
                            <div class="grid grid-cols-2 gap-3 mt-3 pt-3 border-t border-surface-border">
                                <div>
                                    <p class="text-xs text-content-tertiary">Network</p>
                                    <p class="text-xs font-medium text-content-primary" x-text="chainLabel"></p>
                                </div>
                                <div>
                                    <p class="text-xs text-content-tertiary">Available balance</p>
                                    <p class="text-xs font-medium text-content-primary" x-text="nativeBalance"></p>
                                </div>
                            </div>
                        </div>

                        <template x-if="status === 'awaiting' || status === 'submitted' || status === 'confirming' || status === 'pending'">
                            <div class="space-y-3">
                                <template x-for="(step, i) in steps" :key="step.key">
                                    <div class="flex items-center gap-3">
                                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs"
                                            :class="stepState(i) === 'done' ? 'bg-gain/20 text-gain' : (stepState(i) === 'active' ? 'bg-primary-subtle text-primary' : 'bg-surface-overlay text-content-tertiary')"
                                            x-text="stepState(i) === 'done' ? '✓' : (i + 1)"></span>
                                        <span class="text-sm"
                                            :class="stepState(i) === 'pending' ? 'text-content-tertiary' : 'text-content-primary'"
                                            x-text="step.label"></span>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="status === 'idle' || status === 'error'">
                            <div class="space-y-4">
                                <div x-show="errorMessage" x-cloak class="border border-loss/20 bg-loss/10 text-loss rounded-lg px-4 py-3 text-sm" x-text="errorMessage"></div>

                                <template x-if="!isEvm">
                                    <div class="border border-surface-border bg-surface-overlay/40 rounded-lg p-4">
                                        <p class="text-xs text-content-tertiary leading-relaxed">
                                            Your <span class="text-content-secondary font-medium" x-text="providerInfo?.label"></span> is connected and we have your address. Sending <span x-text="networkLabel"></span> directly needs that wallet's own SDK, which is not available here yet. Use the Deposit Funds tab: copy the address, send from your wallet, then submit your transaction hash.
                                        </p>
                                        <button type="button" @click="mode = 'manual'; $nextTick(() => { const f = $root.querySelector('input[name=tx_hash]'); if (f) f.focus(); })"
                                            class="mt-3 w-full py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors">
                                            Go to Deposit Funds
                                        </button>
                                    </div>
                                </template>

                                <template x-if="isEvm">
                                <div>
                                <div x-show="wrongNetwork" x-cloak class="flex items-center justify-between gap-3 border border-warning/20 bg-warning/10 text-warning rounded-lg px-4 py-3 text-sm">
                                    <span>Connected to the wrong network.</span>
                                    <button type="button" @click="switchNetwork()" class="shrink-0 font-semibold underline">Switch</button>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Transfer amount</label>
                                    <input type="number" x-model="transferAmount" min="0" step="any" placeholder="0.00"
                                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                                </div>

                                <p class="text-xs text-content-tertiary">Sending to <span class="font-mono text-content-secondary break-all" x-text="depositAddress"></span></p>

                                <div class="flex gap-3">
                                    <button type="button" @click="closeSheet()" class="flex-1 py-2.5 rounded-lg bg-surface-overlay hover:bg-surface-border text-content-primary text-sm font-medium transition-colors">Cancel</button>
                                    <button type="button" @click="transfer()" :disabled="sending || !transferAmount"
                                        class="flex-1 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors disabled:opacity-60">
                                        <span x-show="!sending">Transfer</span>
                                        <span x-show="sending" x-cloak>Confirm in wallet…</span>
                                    </button>
                                </div>
                                </div>
                                </template>

                        <template x-if="txHash">
                            <div class="border border-surface-border bg-surface-overlay/40 rounded-lg p-4 space-y-2">
                                <p class="text-xs text-content-tertiary">Transaction hash</p>
                                <p class="text-xs font-mono text-content-primary break-all" x-text="txHash"></p>
                                <template x-if="explorerUrl">
                                    <a :href="explorerUrl" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-medium text-primary hover:text-primary-dark transition-colors">
                                        View on block explorer
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path>
                                        </svg>
                                    </a>
                                </template>
                                <p class="text-xs text-content-tertiary pt-1">Submit the hash below so our team can verify and credit your deposit.</p>
                                <button type="button" @click="fillHash()"
                                    class="w-full py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-content-inverse text-sm font-semibold transition-colors">
                                    Fill transaction hash
                                </button>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </template>
        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
<script>
window.wallets = @json($wallets);
window.depositNetworks = @json($networks);
window.depositSubmitUrl = @json(url('/dashboard/deposits'));
window.depositCsrf = @json(csrf_token());

function depositSheet() {
    return {
        // Manual deposit (existing behaviour)
        open: false,
        mode: 'manual',
        network: 'solana',
        networkLabel: 'Solana',
        amount: '',
        copied: null,

        // Wallet connection state
        detectedWallets: [],
        selectedWallet: null,
        connected: false,
        connecting: false,
        connectingId: null,
        sending: false,
        address: null,
        chainId: null,
        walletKind: null,
        chainLabel: '',
        nativeBalance: '0',
        transferAmount: '',
        txHash: '',
        status: 'idle',
        errorMessage: '',
        wrongNetwork: false,

        steps: [
            { key: 'awaiting', label: 'Awaiting your approval in wallet' },
            { key: 'submitted', label: 'Transaction submitted' },
            { key: 'confirming', label: 'Confirming on-chain' },
            { key: 'pending', label: 'Pending verification' },
        ],

        init() {
            if (!window.DepositWallet) return;

            this.scanWallets();

            // EIP-6963 wallets announce themselves after first paint.
            window.DepositWallet.onChange(() => this.scanWallets());

            window.DepositWallet.bind({
                onAccountsChanged: (addr) => {
                    if (!addr) {
                        this.connected = false;
                        this.address = null;
                        this.status = 'idle';
                    } else {
                        this.address = addr;
                        this.connected = true;
                        this.refreshWalletDetails();
                    }
                },
                onChainChanged: (id) => {
                    this.chainId = id;
                    this.checkNetwork();
                    this.refreshWalletDetails();
                },
            });

            this.restoreAnySession();
        },

        /** Every wallet present on this device/browser, across all chains. */
        scanWallets() {
            this.detectedWallets = window.DepositWallet.scan();
            return this.detectedWallets;
        },

        async restoreAnySession() {
            for (const w of this.detectedWallets) {
                const existing = await window.DepositWallet.restore(w.id);
                if (existing) {
                    this.applyConnection(existing);
                    return;
                }
            }
        },

        applyConnection(result) {
            this.selectedWallet = result.walletId;
            this.address = result.address;
            this.chainId = result.chainId;
            this.walletKind = result.kind;
            this.providerInfo = { label: result.label, icon: result.icon };
            this.connected = true;
            this.checkNetwork();
            this.refreshWalletDetails();
        },

        async connect(wallet) {
            this.connecting = true;
            this.connectingId = wallet.id;
            this.errorMessage = '';

            try {
                const result = await window.DepositWallet.connect(wallet.id);
                this.applyConnection(result);
            } catch (e) {
                this.errorMessage = e.message || 'Could not connect to that wallet.';
            } finally {
                this.connecting = false;
                this.connectingId = null;
            }
        },

        linksForNetwork() {
            return window.DepositWallet.linksFor(this.providerKind);
        },

        get providerKind() {
            const net = (window.depositNetworks || {})[this.network];
            return (net && net.provider) || null;
        },

        get isEvm() {
            return this.walletKind === 'evm';
        },

        /** True when this chain has some browser wallet, even if not EVM. */
        get hasWalletSupport() {
            return this.providerKind !== null;
        },

        /** Wallets able to broadcast on the selected chain. */
        get compatibleWallets() {
            const kind = this.providerKind;
            if (!kind) return [];
            return this.detectedWallets.filter((w) => w.kind === kind);
        },

        /** True only when a connected wallet can actually broadcast a transfer. */
        get canSendFromWallet() {
            return this.isEvm && this.connected;
        },

        get canSend() {
            return this.canSendFromWallet && window.DepositWallet.canSend(this.walletKind);
        },

        kindLabel(kind) {
            if (kind === 'evm') return 'EVM networks';
            if (kind === 'solana') return 'Solana';
            if (kind === 'sui') return 'Sui';
            return kind || 'Other';
        },

        get depositAddress() {
            return (window.wallets || {})[this.network] || '';
        },

        get explorerUrl() {
            const net = (window.depositNetworks || {})[this.network];
            if (!net || !net.explorer || !this.txHash) return '';
            return net.explorer.replace('{hash}', this.txHash);
        },

        get shortAddress() {
            return window.DepositWallet ? window.DepositWallet.shortenAddress(this.address) : '';
        },

        checkNetwork() {
            const net = (window.depositNetworks || {})[this.network];
            if (!net || !net.chain_id) { this.wrongNetwork = false; return; }
            this.wrongNetwork = this.chainId !== '0x' + net.chain_id.toString(16);
        },

        async refreshWalletDetails() {
            const net = (window.depositNetworks || {})[this.network];
            this.chainLabel = net ? net.name : '';
            if (!this.address) return;
            try {
                const bal = await window.DepositWallet.balanceOf(this.address, this.walletKind);
                this.nativeBalance = bal === null ? '—' : bal.toFixed(6);
            } catch (e) {
                this.nativeBalance = '—';
            }
        },

        disconnect() {
            this.connected = false;
            this.address = null;
            this.chainId = null;
            this.selectedWallet = null;
            this.walletKind = null;
            this.providerInfo = null;
            this.nativeBalance = '0';
            this.transferAmount = '';
            this.txHash = '';
            this.status = 'idle';
            this.errorMessage = '';
        },

        async switchNetwork() {
            const net = (window.depositNetworks || {})[this.network];
            if (!net || !net.chain_id) return;
            const ok = await window.DepositWallet.switchNetwork('0x' + net.chain_id.toString(16));
            if (ok) this.checkNetwork();
            else this.errorMessage = 'Could not switch networks automatically. Please switch manually in your wallet.';
        },

        async transfer() {
            this.errorMessage = '';
            this.sending = true;
            this.status = 'awaiting';

            try {
                const value = parseFloat(this.transferAmount);

                if (!value || value <= 0) {
                    throw new Error('Enter an amount greater than zero.');
                }

                const bal = await window.DepositWallet.balanceOf(this.address, this.walletKind);

                if (bal !== null && value > bal) {
                    throw new Error('Amount exceeds your available balance.');
                }

                this.txHash = await window.DepositWallet.send(this.selectedWallet, this.depositAddress, value);

                this.status = 'submitted';
                this.pollConfirmations();
            } catch (e) {
                this.status = 'error';
                this.errorMessage = e.message || 'The transfer was not completed.';
            } finally {
                this.sending = false;
            }
        },

        async pollConfirmations() {
            // The backend does not verify on-chain receipts, so we only report
            // that the transaction was broadcast. Crediting happens after review.
            this.status = 'confirming';

            const net = (window.depositNetworks || {})[this.network];
            if (!net || !net.chain_id) return;

            const attempts = 15;
            const delay = 4000;

            for (let i = 0; i < attempts; i++) {
                try {
                    const receipt = await window.DepositWallet.receipt(this.selectedWallet, this.txHash);

                    if (receipt) {
                        this.status = 'pending';
                        return;
                    }
                } catch (e) {
                    // Receipt unavailable yet; keep waiting.
                }

                await new Promise((r) => setTimeout(r, delay));
            }

            this.status = 'pending';
        },

        stepState(index) {
            const order = ['awaiting', 'submitted', 'confirming', 'pending'];
            const current = order.indexOf(this.status);

            if (current === -1) return 'pending';
            if (index < current) return 'done';
            if (index === current) return 'active';
            return 'pending';
        },

        fillHash() {
            // Switch to the manual tab so the filled hash is visible and submittable.
            this.mode = 'manual';

            const form = this.$root.querySelector('form[method="POST"]');
            if (!form) return;
            const input = form.querySelector('input[name="tx_hash"]');
            if (input) {
                input.value = this.txHash;
                input.dispatchEvent(new Event('input', { bubbles: true }));
                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        },

        closeSheet() {
            this.open = false;
            this.errorMessage = '';
            this.mode = 'manual';
        },
    };
}
</script>
@endpush
