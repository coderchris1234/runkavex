/**
 * Deposit wallet connector for the deposit bottom-sheet.
 *
 * Scans the device for every compatible wallet we can recognise, across all
 * supported chains (EVM, Solana, Sui), and exposes them as a list the user can
 * pick from. Detection is passive and local: it only checks which wallet
 * extensions/apps inject themselves into the page. Connecting always requires
 * the user to approve inside their own wallet.
 *
 * This never reads private keys or seed phrases. A page cannot access them;
 * we only ever request a public address and, where the chain allows it,
 * ask the wallet to sign a transfer.
 *
 * EIP-6963 is used when available (the multi-wallet discovery standard),
 * with a fallback scan of injected globals for older extensions.
 */
(function () {
    'use strict';

    /**
     * Wallet registry. `test` receives a window-like object and returns true if
     * that wallet is present. `kind` decides which connect/send path is used.
     */
    const WALLET_REGISTRY = [
        // ---- EVM (EIP-1193) ----
        { id: 'metamask', label: 'MetaMask', icon: '🦊', kind: 'evm', rdns: 'io.metamask', test: (w) => !!(w.ethereum && w.ethereum.isMetaMask) },
        { id: 'coinbase', label: 'Coinbase Wallet', icon: '🔵', kind: 'evm', rdns: 'com.coinbase.wallet', test: (w) => !!(w.ethereum && (w.ethereum.isCoinbaseWallet || w.ethereum.isCoinbaseWalletSDK)) },
        { id: 'trust', label: 'Trust Wallet', icon: '🛡️', kind: 'evm', test: (w) => !!(w.ethereum && w.ethereum.isTrust) },
        { id: 'rabby', label: 'Rabby', icon: '🐇', kind: 'evm', rdns: 'io.rabby', test: (w) => !!(w.ethereum && w.ethereum.isRabby) },
        { id: 'brave', label: 'Brave Wallet', icon: '🦁', kind: 'evm', test: (w) => !!(w.ethereum && w.ethereum.isBraveWallet) },
        { id: 'okx', label: 'OKX Wallet', icon: '🅾️', kind: 'evm', rdns: 'com.okex.wallet', test: (w) => !!(w.ethereum && w.ethereum.isOkxWallet) },
        { id: 'binance', label: 'Binance Web3 Wallet', icon: '🟡', kind: 'evm', test: (w) => !!(w.ethereum && w.ethereum.isBinanceChain) },
        { id: 'zerion', label: 'Zerion', icon: '🔷', kind: 'evm', rdns: 'io.zerion', test: (w) => !!(w.ethereum && w.ethereum.isZerion) },
        { id: 'safe', label: 'Safe', icon: '🔒', kind: 'evm', rdns: 'safe.global', test: (w) => !!(w.ethereum && w.ethereum.isSafe) },
        { id: 'frontier', label: 'Frontier Wallet', icon: '🧭', kind: 'evm', rdns: 'frontier.xyz', test: (w) => !!(w.ethereum && w.ethereum.isFrontier) },
        { id: 'tokenpocket', label: 'TokenPocket', icon: '🎩', kind: 'evm', test: (w) => !!(w.ethereum && w.ethereum.isTokenPocket) },
        { id: 'evm-generic', label: 'Browser Wallet', icon: '👛', kind: 'evm', test: (w) => !!w.ethereum, fallback: true },

        // ---- Solana ----
        { id: 'phantom', label: 'Phantom', icon: '👻', kind: 'solana', scheme: 'phantom://', test: (w) => !!(w.phantom && w.phantom.isPhantom) },
        { id: 'backpack', label: 'Backpack', icon: '🎒', kind: 'solana', scheme: 'backpack://', test: (w) => !!w.backpack },
        { id: 'solflare', label: 'Solflare', icon: '🔥', kind: 'solana', scheme: 'solflare://', test: (w) => !!w.solflare },
        { id: 'solana-generic', label: 'Solana Wallet', icon: '◎', kind: 'solana', scheme: 'solflare://', test: (w) => !!w.solana, fallback: true },

        // ---- Sui ----
        { id: 'suiwallet', label: 'Sui Wallet', icon: '🌊', kind: 'sui', scheme: 'suiwallet://', test: (w) => !!w.suiwallet },
        { id: 'sui-generic', label: 'Sui Wallet', icon: '🌊', kind: 'sui', scheme: 'suiwallet://', test: (w) => !!w.sui, fallback: true },
    ];

    /** Deep links shown when nothing is detected, grouped per chain. */
    const MOBILE_LINKS = {
        evm: [
            { name: 'MetaMask', scheme: 'metamask://', icon: '🦊' },
            { name: 'Trust Wallet', scheme: 'trust://', icon: '🛡️' },
            { name: 'Coinbase Wallet', scheme: 'cbwallet://', icon: '🔵' },
            { name: 'OKX Wallet', scheme: 'okx://', icon: '🅾️' },
            { name: 'TokenPocket', scheme: 'tpoutside://', icon: '🎩' },
            { name: 'Zerion', scheme: 'zerion://', icon: '🔷' },
        ],
        solana: [
            { name: 'Phantom', scheme: 'phantom://', icon: '👻' },
            { name: 'Solflare', scheme: 'solflare://', icon: '🔥' },
            { name: 'Backpack', scheme: 'backpack://', icon: '🎒' },
        ],
        sui: [
            { name: 'Sui Wallet', scheme: 'suiwallet://', icon: '🌊' },
        ],
    };

    /** Chains we can send a native transfer from, per wallet kind. */
    const SENDABLE_KINDS = ['evm'];

    // EIP-6963 announces wallets asynchronously, so results are cached.
    const eip6963 = { providers: [], done: false, listeners: [] };

    function initEip6963() {
        if (eip6963.done) return;
        eip6963.done = true;

        window.addEventListener('eip6963:announceProvider', (event) => {
            const { info, provider } = event.detail || {};
            if (!info || !provider) return;
            if (!eip6963.providers.some((p) => p.info.rdns === info.rdns)) {
                eip6963.providers.push({ info, provider });
            }
            eip6963.listeners.forEach((fn) => fn());
        });

        window.dispatchEvent(new Event('eip6963:requestProvider'));
    }

    function onEip6963Change(fn) {
        if (eip6963.listeners.indexOf(fn) === -1) eip6963.listeners.push(fn);
    }

    function shortenAddress(address) {
        if (!address) return '';
        return address.length <= 14 ? address : address.slice(0, 6) + '…' + address.slice(-4);
    }

    function evmProviderList() {
        const injected = window.ethereum;
        if (!injected) return [];
        if (Array.isArray(injected.providers) && injected.providers.length) {
            return injected.providers;
        }
        return [injected];
    }

    /**
     * Every wallet currently present on this device/browser.
     * Returns [{ id, label, icon, kind, scheme }] with no provider internals.
     */
    function scan() {
        initEip6963();

        const found = [];
        const seen = {};

        const push = (id, label, icon, kind, scheme) => {
            if (seen[id]) return;
            seen[id] = true;
            found.push({ id, label, icon, kind, scheme: scheme || null });
        };

        // 1. EIP-6963 (authoritative when the wallet supports it)
        eip6963.providers.forEach(({ info, provider }) => {
            const match = WALLET_REGISTRY.find((w) => w.rdns && w.rdns === info.rdns);
            if (match) {
                push(match.id, info.icon || match.icon, match.icon, match.kind, match.scheme);
            } else {
                push(
                    'eip6963-' + info.rdns,
                    info.name || 'Browser Wallet',
                    info.icon || '👛',
                    'evm',
                    null
                );
            }
        });

        // 2. Scan injected globals so older extensions still show up.
        evmProviderList().forEach((provider) => {
            const match = WALLET_REGISTRY.find((w) => w.kind === 'evm' && w.test({ ethereum: provider }));
            if (match) {
                push(match.id, match.label, match.icon, match.kind, match.scheme);
            } else if (!eip6963.providers.length) {
                push('evm-generic', 'Browser Wallet', '👛', 'evm', null);
            }
        });

        WALLET_REGISTRY.forEach((w) => {
            if (w.kind === 'evm') return;
            if (w.test(window)) {
                push(w.id, w.label, w.icon, w.kind, w.scheme);
            }
        });

        // A generic entry is only useful when nothing more specific was found.
        return found.filter((w) => {
            if (!/^(evm|solana|sui)-generic$/.test(w.id)) return true;
            return !found.some((o) => o.kind === w.kind && o.id !== w.id);
        });
    }

    function findWallet(id) {
        return WALLET_REGISTRY.find((w) => w.id === id) || null;
    }

    function evmProviderFor(id) {
        const wanted = findWallet(id);
        const list = evmProviderList();

        // Announced wallets are the most reliable source for a specific provider.
        const announced = eip6963.providers.find(({ info }) => wanted && info.rdns === wanted.rdns);
        if (announced) return announced.provider;

        for (const provider of list) {
            const match = WALLET_REGISTRY.find((w) => w.kind === 'evm' && w.test({ ethereum: provider }));
            if (match && match.id === id) return provider;
        }

        return list[0] || null;
    }

    window.DepositWallet = {
        shortenAddress,
        onChange: onEip6963Change,
        scan,

        linksFor(kind) {
            return MOBILE_LINKS[kind] || MOBILE_LINKS.evm;
        },

        canSend(kind) {
            return SENDABLE_KINDS.indexOf(kind) !== -1;
        },

        async connect(id) {
            const meta = findWallet(id) || { kind: 'evm', label: 'Browser Wallet' };

            if (meta.kind === 'evm') {
                const provider = evmProviderFor(id);
                if (!provider) throw new Error('That wallet is no longer available. Reload the page and try again.');

                const accounts = await provider.request({ method: 'eth_requestAccounts' });
                if (!accounts || !accounts.length) throw new Error('Wallet connection was declined.');

                return {
                    walletId: id,
                    address: accounts[0],
                    label: meta.label,
                    icon: meta.icon,
                    kind: 'evm',
                    chainId: await provider.request({ method: 'eth_chainId' }),
                };
            }

            if (meta.kind === 'solana') {
                const provider = window.phantom || window.solflare || window.backpack || window.solana;
                const res = await provider.connect();
                return {
                    walletId: id,
                    address: res.publicKey.toString(),
                    label: meta.label,
                    icon: meta.icon,
                    kind: 'solana',
                    chainId: null,
                };
            }

            if (meta.kind === 'sui') {
                const provider = window.suiwallet || window.sui;
                const res = await provider.request({ method: 'sui_getAccounts', params: [] });
                if (!res || !res.accounts || !res.accounts.length) {
                    throw new Error('Wallet connection was declined.');
                }
                return {
                    walletId: id,
                    address: res.accounts[0].address,
                    label: meta.label,
                    icon: meta.icon,
                    kind: 'sui',
                    chainId: null,
                };
            }

            throw new Error('Unsupported wallet.');
        },

        /** Silent check so a previously authorised wallet shows as connected. */
        async restore(id) {
            const meta = findWallet(id);
            if (!meta) return null;

            try {
                if (meta.kind === 'evm') {
                    const provider = evmProviderFor(id);
                    if (!provider) return null;
                    const accounts = await provider.request({ method: 'eth_accounts' });
                    if (!accounts || !accounts.length) return null;
                    return {
                        walletId: id,
                        address: accounts[0],
                        label: meta.label,
                        icon: meta.icon,
                        kind: 'evm',
                        chainId: await provider.request({ method: 'eth_chainId' }),
                    };
                }

                if (meta.kind === 'solana') {
                    const provider = window.phantom || window.solflare || window.backpack || window.solana;
                    if (!provider || !provider.isConnected) return null;
                    return {
                        walletId: id,
                        address: provider.publicKey.toString(),
                        label: meta.label,
                        icon: meta.icon,
                        kind: 'solana',
                        chainId: null,
                    };
                }

                if (meta.kind === 'sui') {
                    const provider = window.suiwallet || window.sui;
                    const res = await provider.request({ method: 'sui_getAccounts', params: [] });
                    if (!res || !res.accounts || !res.accounts.length) return null;
                    return {
                        walletId: id,
                        address: res.accounts[0].address,
                        label: meta.label,
                        icon: meta.icon,
                        kind: 'sui',
                        chainId: null,
                    };
                }
            } catch (e) {
                return null;
            }

            return null;
        },

        async balanceOf(address, kind) {
            if (kind !== 'evm') return null;

            const provider = evmProviderList()[0];
            if (!provider) return null;

            const hex = await provider.request({ method: 'eth_getBalance', params: [address, 'latest'] });
            return parseInt(hex, 16) / 1e18;
        },

        /** Receipt lookup, so a non-EVM chain can be polled the same way. */
        async receipt(id, hash) {
            const provider = evmProviderFor(id);
            if (!provider || !hash) return null;

            try {
                const receipt = await provider.request({
                    method: 'eth_getTransactionReceipt',
                    params: [hash],
                });
                return receipt && receipt.blockNumber ? receipt : null;
            } catch (e) {
                return null;
            }
        },

        async estimateFee(from, to) {
            const provider = evmProviderList()[0];
            if (!provider) return null;

            try {
                const gas = await provider.request({ method: 'eth_estimateGas', params: [{ from, to, value: '0x0' }] });
                const price = await provider.request({ method: 'eth_gasPrice' });
                return (parseInt(gas, 16) * parseInt(price, 16)) / 1e18;
            } catch (e) {
                return null;
            }
        },

        async switchNetwork(chainIdHex) {
            const provider = evmProviderList()[0];
            if (!provider || !chainIdHex) return false;

            try {
                const current = await provider.request({ method: 'eth_chainId' });
                if (current === chainIdHex) return true;
                await provider.request({
                    method: 'wallet_switchEthereumChain',
                    params: [{ chainId: chainIdHex }],
                });
                return true;
            } catch (e) {
                return false;
            }
        },

        /**
         * Broadcast a native transfer. The user's wallet displays the full
         * details and requires their approval before anything is signed.
         */
        async send(id, to, amountEth) {
            const meta = findWallet(id);

            if (!meta || meta.kind !== 'evm') {
                const label = meta ? meta.label : 'This wallet';
                throw new Error(
                    'Sending directly from ' + label + ' is not available yet. ' +
                    'Copy the deposit address, send from your wallet, then submit your transaction hash.'
                );
            }

            const provider = evmProviderFor(id);
            if (!provider) throw new Error('That wallet is no longer available.');

            const accounts = await provider.request({ method: 'eth_accounts' });
            if (!accounts || !accounts.length) throw new Error('Connect your wallet before sending.');

            const value = '0x' + BigInt(Math.round(amountEth * 1e18)).toString(16);

            return provider.request({
                method: 'eth_sendTransaction',
                params: [{ from: accounts[0], to, value }],
            });
        },

        bind(handlers) {
            const providers = evmProviderList();
            providers.forEach((provider) => {
                if (!provider.on) return;
                provider.on('accountsChanged', (accounts) => {
                    handlers.onAccountsChanged(accounts && accounts.length ? accounts[0] : null);
                });
                provider.on('chainChanged', (chainId) => handlers.onChainChanged(chainId));
            });
        },
    };
})();