<?php

namespace App\Console\Commands;

use App\Services\MarketPriceService;
use Illuminate\Console\Command;

class UpdateMarketPrices extends Command
{
    protected $signature = 'prices:update';

    protected $description = 'Fetch live prices from free APIs (CoinGecko for crypto, Yahoo Finance for forex/stocks/ETFs/indices) and update the markets table';

    public function handle(MarketPriceService $service): int
    {
        $this->info('Fetching live crypto prices...');

        try {
            $crypto = $service->updateCryptoPrices();
            $this->info("Updated prices for {$crypto} crypto assets.");

            $this->info('Fetching live forex / stock / ETF / index prices...');

            $yahoo = $service->updateYahooPrices();
            $this->info("Updated prices for {$yahoo} forex/stock/ETF/index assets.");
        } catch (\Throwable $e) {
            $this->error('Failed to update prices: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info('Done.');

        return self::SUCCESS;
    }
}
