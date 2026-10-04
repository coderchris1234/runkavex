<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Deposit Networks
    |--------------------------------------------------------------------------
    |
    | Single source of truth for every supported deposit network. Wallet
    | addresses continue to come from services.crypto.wallets (the .env
    | values) so existing behaviour is unchanged; this file only adds the
    | per-network metadata the deposit sheet needs.
    |
    | 'evm' networks expose window.ethereum and can receive funds directly
    | from a connected browser wallet. Non-EVM chains (Solana, Sui, Bitcoin,
    | Robinhood) have no EIP-1193 provider in a normal browser, so they are
    | presented as manual address deposits only.
    |
    */

    'confirmations_required' => (int) env('DEPOSIT_CONFIRMATIONS_REQUIRED', 1),

    'networks' => [

        'solana' => [
            'name' => 'Solana',
            'code' => 'SOL',
            'evm' => false,
            'provider' => 'solana',
            'decimals' => 9,
            'chain_id' => null,
            'explorer' => 'https://solscan.io/tx/{hash}',
            'address' => env('WALLET_SOLANA'),
        ],

        'ethereum' => [
            'name' => 'Ethereum',
            'code' => 'ETH',
            'evm' => true,
            'provider' => 'evm',
            'decimals' => 18,
            'chain_id' => 1,
            'explorer' => 'https://etherscan.io/tx/{hash}',
            'address' => env('WALLET_ETHEREUM'),
        ],

        'bitcoin_taproot' => [
            'name' => 'Bitcoin (Taproot)',
            'code' => 'BTC',
            'evm' => false,
            'provider' => null,
            'decimals' => 8,
            'chain_id' => null,
            'explorer' => 'https://mempool.space/tx/{hash}',
            'address' => env('WALLET_BITCOIN_TAPROOT'),
        ],

        'bitcoin_segwit' => [
            'name' => 'Bitcoin (Native SegWit)',
            'code' => 'BTC',
            'evm' => false,
            'provider' => null,
            'decimals' => 8,
            'chain_id' => null,
            'explorer' => 'https://mempool.space/tx/{hash}',
            'address' => env('WALLET_BITCOIN_SEGWIT'),
        ],

        'robinhood' => [
            'name' => 'Robinhood',
            'code' => 'ROBIN',
            'evm' => false,
            'provider' => null,
            'decimals' => 8,
            'chain_id' => null,
            'explorer' => null,
            'address' => env('WALLET_ROBINHOOD'),
        ],

        'base' => [
            'name' => 'Base',
            'code' => 'BASE',
            'evm' => true,
            'provider' => 'evm',
            'decimals' => 18,
            'chain_id' => 8453,
            'explorer' => 'https://basescan.org/tx/{hash}',
            'address' => env('WALLET_BASE'),
        ],

        'sui' => [
            'name' => 'Sui',
            'code' => 'SUI',
            'evm' => false,
            'provider' => 'sui',
            'decimals' => 9,
            'chain_id' => null,
            'explorer' => 'https://suiscan.xyz/mainnet/tx/{hash}',
            'address' => env('WALLET_SUI'),
        ],

        'polygon' => [
            'name' => 'Polygon',
            'code' => 'MATIC',
            'evm' => true,
            'provider' => 'evm',
            'decimals' => 18,
            'chain_id' => 137,
            'explorer' => 'https://polygonscan.com/tx/{hash}',
            'address' => env('WALLET_POLYGON'),
        ],

        'hyper_evm' => [
            'name' => 'HyperEVM',
            'code' => 'HYPE',
            'evm' => true,
            'provider' => 'evm',
            'decimals' => 18,
            'chain_id' => 999,
            'explorer' => 'https://hyperevmscan.io/tx/{hash}',
            'address' => env('WALLET_HYPER_EVM'),
        ],

    ],

];