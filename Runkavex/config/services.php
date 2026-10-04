<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'crypto' => [
        'wallets' => [
            'solana' => env('WALLET_SOLANA'),
            'ethereum' => env('WALLET_ETHEREUM'),
            'bitcoin_taproot' => env('WALLET_BITCOIN_TAPROOT'),
            'bitcoin_segwit' => env('WALLET_BITCOIN_SEGWIT'),
            'robinhood' => env('WALLET_ROBINHOOD'),
            'base' => env('WALLET_BASE'),
            'sui' => env('WALLET_SUI'),
            'polygon' => env('WALLET_POLYGON'),
            'hyper_evm' => env('WALLET_HYPER_EVM'),
        ],
    ],

];
