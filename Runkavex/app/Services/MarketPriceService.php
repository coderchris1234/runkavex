<?php

namespace App\Services;

use App\Models\Market;
use Illuminate\Support\Facades\Http;

class MarketPriceService
{
    protected array $coinMap = [
        'BTC' => 'bitcoin',
        'ETH' => 'ethereum',
        'USDT' => 'tether',
        'USDC' => 'usd-coin',
        'BNB' => 'binancecoin',
        'SOL' => 'solana',
        'XRP' => 'ripple',
        'ADA' => 'cardano',
        'DOGE' => 'dogecoin',
        'TRX' => 'tron',
        'DOT' => 'polkadot',
        'LINK' => 'chainlink',
        'AVAX' => 'avalanche-2',
        'MATIC' => 'matic-network',
        'LTC' => 'litecoin',
        'BCH' => 'bitcoin-cash',
        'XMR' => 'monero',
        'XLM' => 'stellar',
        'HBAR' => 'hedera-hashgraph',
        'SUI' => 'sui',
        'ZEC' => 'zcash',
        'SHIB' => 'shiba-inu',
        'CRO' => 'crypto-com-chain',
        'UNI' => 'uniswap',
        'TAO' => 'bittensor',
        'HYPE' => 'hyperliquid',
        'DAI' => 'dai',
        'USDS' => 'usds',
        'USDE' => 'ethena-usde',
        'PYUSD' => 'paypal-usd',
        'XAUT' => 'tether-gold',
        'WLFI' => 'worldliberty-financial',
        'WBT' => 'whitebit',
        'GRAM' => 'gram',
        'LEO' => 'leo-token',
    ];

    protected array $yahooMap = [
        // forex
        'EUR/USD' => 'EURUSD=X',
        'GBP/USD' => 'GBPUSD=X',
        'USD/JPY' => 'JPY=X',
        'AUD/USD' => 'AUDUSD=X',
        'USD/CHF' => 'CHF=X',
        'NZD/USD' => 'NZDUSD=X',
        'USD/CAD' => 'CAD=X',
        'EUR/GBP' => 'EURGBP=X',
        'EUR/JPY' => 'EURJPY=X',
        'GBP/JPY' => 'GBPJPY=X',
        'XAU/USD' => 'GC=F',
        'XAG/USD' => 'SI=F',
        // index
        'SPX' => '^GSPC',
        'IXIC' => '^IXIC',
        'DJI' => '^DJI',
        'FTSE' => '^FTSE',
        'DAX' => '^GDAXI',
        'N225' => '^N225',
        'HSI' => '^HSI',
        'STOXX50E' => '^STOXX50E',
    ];

    public function updateCryptoPrices(): int
    {
        $cryptoSymbols = Market::where('class', 'crypto')
            ->whereNotNull('symbol')
            ->pluck('symbol')
            ->unique()
            ->values()
            ->all();

        if (empty($cryptoSymbols)) {
            return 0;
        }

        $prices = $this->fetchPrices($cryptoSymbols);

        if (empty($prices)) {
            return 0;
        }

        $updated = 0;
        foreach ($cryptoSymbols as $symbol) {
            $coinId = $this->coinMap[strtoupper($symbol)] ?? strtolower($symbol);
            $data = $prices[$coinId] ?? null;
            if (! $data || ! isset($data['usd'])) {
                continue;
            }

            $change = isset($data['usd_24h_change'])
                ? ($data['usd_24h_change'] >= 0 ? '+' : '') . number_format($data['usd_24h_change'], 2) . '%'
                : null;

            Market::where('class', 'crypto')
                ->where('symbol', $symbol)
                ->update([
                    'price' => number_format($data['usd'], 2),
                    'price_change' => $change,
                ]);

            $updated++;
        }

        return $updated;
    }

    public function updateYahooPrices(): int
    {
        $assets = Market::whereIn('class', ['forex', 'stock', 'etf', 'index'])
            ->whereNotNull('symbol')
            ->get(['id', 'symbol', 'class'])
            ->groupBy('class');

        $updated = 0;

        foreach ($assets as $class => $items) {
            $symbols = $items->pluck('symbol')->unique()->values()->all();
            $quotes = $this->fetchYahooQuotes($symbols, $class);

            if (empty($quotes)) {
                continue;
            }

            foreach ($items as $item) {
                $yahoo = $this->resolveYahooSymbol($item->symbol, $class);
                if (! $yahoo) {
                    continue;
                }
                $q = $quotes[$yahoo] ?? null;
                if (! $q || $q['price'] === null) {
                    continue;
                }

                $change = $q['change'] !== null
                    ? ($q['change'] >= 0 ? '+' : '') . number_format($q['change'], 2) . '%'
                    : null;

                Market::where('id', $item->id)->update([
                    'price' => number_format($q['price'], 2),
                    'price_change' => $change,
                ]);

                $updated++;
            }
        }

        return $updated;
    }

    protected function resolveYahooSymbol(string $symbol, string $class): ?string
    {
        if (in_array($class, ['stock', 'etf'], true)) {
            return strtoupper($symbol);
        }

        return $this->yahooMap[$symbol] ?? null;
    }

    protected function fetchYahooQuotes(array $symbols, string $class): array
    {
        $result = [];

        foreach ($symbols as $symbol) {
            $yahoo = $this->resolveYahooSymbol($symbol, $class);
            if (! $yahoo) {
                continue;
            }

            try {
                $response = Http::timeout(12)->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ])->get(
                    'https://query1.finance.yahoo.com/v8/finance/chart/' . $yahoo . '?interval=1d&range=1d'
                );

                if (! $response->successful()) {
                    continue;
                }

                $data = $response->json();
                $meta = $data['chart']['result'][0]['meta'] ?? null;
                if (! $meta) {
                    continue;
                }

                $result[$yahoo] = [
                    'price' => $meta['regularMarketPrice'] ?? null,
                    'change' => $meta['regularMarketChangePercent'] ?? null,
                ];
            } catch (\Throwable $e) {
                continue;
            }
        }

        return $result;
    }

    protected function fetchPrices(array $symbols): array
    {
        $coinIds = array_map(
            fn ($symbol) => $this->coinMap[strtoupper($symbol)] ?? strtolower($symbol),
            $symbols
        );
        $coinIds = array_values(array_unique(array_filter($coinIds)));

        try {
            $response = Http::timeout(15)->retry(2, 500)->get(
                'https://api.coingecko.com/api/v3/simple/price',
                [
                    'ids' => implode(',', $coinIds),
                    'vs_currencies' => 'usd',
                    'include_24hr_change' => 'true',
                ]
            );

            if (! $response->successful() || empty($response->json())) {
                return $this->fetchViaSearch($coinIds);
            }

            return $response->json();
        } catch (\Throwable $e) {
            try {
                return $this->fetchViaSearch($coinIds);
            } catch (\Throwable $e2) {
                return [];
            }
        }
    }

    protected function fetchViaSearch(array $coinIds): array
    {
        $result = [];
        try {
            $all = Http::timeout(15)->get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'usd',
                'per_page' => 250,
                'page' => 1,
                'price_change_percentage' => '24h',
            ]);

            if (! $all->successful()) {
                return [];
            }

            foreach ($all->json() as $coin) {
                if (in_array($coin['id'], $coinIds, true)) {
                    $result[$coin['id']] = [
                        'usd' => $coin['current_price'],
                        'usd_24h_change' => $coin['price_change_percentage_24h'] ?? null,
                    ];
                }
            }
        } catch (\Throwable $e) {
            return [];
        }

        return $result;
    }
}
