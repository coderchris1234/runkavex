<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->string('symbol');
            $table->string('class');
            $table->string('price')->nullable();
            $table->string('price_change')->nullable();
            $table->text('img')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $assets = [
            ['id' => 83, 'name' => 'Bittensor', 'symbol' => 'TAO', 'price' => '335.37', 'change' => '-0.04%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/28452/large/ARUsPeNQ_400x400.jpeg?1696527447'],
            ['id' => 81, 'name' => 'World Liberty Financial', 'symbol' => 'WLFI', 'price' => '0.09', 'change' => '-3.03%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/50767/large/wlfi.png?1756438915'],
            ['id' => 69, 'name' => 'Stellar', 'symbol' => 'XLM', 'price' => '0.18', 'change' => '+3.68%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/100/large/fmpFRHHQ_400x400.jpg?1735231350'],
            ['id' => 76, 'name' => 'Zcash', 'symbol' => 'ZEC', 'price' => '845.11', 'change' => '+6.08%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/486/large/Brandmark-Yellow_%281%29.png?1785810558'],
            ['id' => 62, 'name' => 'USDS', 'symbol' => 'USDS', 'price' => '1.00', 'change' => '+0.01%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/39926/large/usds.webp?1726666683'],
            ['id' => 64, 'name' => 'Hyperliquid', 'symbol' => 'HYPE', 'price' => '82.38', 'change' => '+1.24%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/50882/large/hyperliquid.jpg?1729431300'],
            ['id' => 66, 'name' => 'Monero', 'symbol' => 'XMR', 'price' => '513.00', 'change' => '+1.20%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/69/large/monero_logo.png?1696501460'],
            ['id' => 10, 'name' => 'TRON', 'symbol' => 'TRX', 'price' => '0.33', 'change' => '+1.19%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/1094/large/photo_2026-04-13_09-59-16.png?1776048311'],
            ['id' => 1, 'name' => 'Bitcoin', 'symbol' => 'BTC', 'price' => '78,339.00', 'change' => '+2.09%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/1/large/bitcoin.png?1696501400'],
            ['id' => 60, 'name' => 'Figure Heloc', 'symbol' => 'FIGR_HELOC', 'price' => '1.01', 'change' => '-2.03%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/68480/large/figure.png?1755863954'],
            ['id' => 63, 'name' => 'Bitcoin Cash', 'symbol' => 'BCH', 'price' => '250.20', 'change' => '+2.60%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/780/large/bitcoin-cash-circle.png?1696501932'],
            ['id' => 6, 'name' => 'XRP', 'symbol' => 'XRP', 'price' => '1.38', 'change' => '+4.34%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png?1696501442'],
            ['id' => 7, 'name' => 'USDC', 'symbol' => 'USDC', 'price' => '1.00', 'change' => '+0.01%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/6319/large/USDC.png?1769615602'],
            ['id' => 4, 'name' => 'BNB', 'symbol' => 'BNB', 'price' => '713.73', 'change' => '+4.44%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/825/large/bnb-icon2_2x.png?1696501970'],
            ['id' => 72, 'name' => 'Dai', 'symbol' => 'DAI', 'price' => '1.00', 'change' => '+0.01%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/9956/large/Badge_Dai.png?1696509996'],
            ['id' => 9, 'name' => 'Dogecoin', 'symbol' => 'DOGE', 'price' => '0.08', 'change' => '+2.98%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/5/large/dogecoin.png?1696501409'],
            ['id' => 68, 'name' => 'Canton', 'symbol' => 'CC', 'price' => '0.11', 'change' => '-1.31%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/70468/large/Canton-Ticker_%281%29.png?1762826299'],
            ['id' => 65, 'name' => 'LEO Token', 'symbol' => 'LEO', 'price' => '9.36', 'change' => '+1.25%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/8418/large/leo-token.png?1696508607'],
            ['id' => 67, 'name' => 'Ethena USDe', 'symbol' => 'USDE', 'price' => '1.00', 'change' => '+0.02%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/33613/large/usde.png?1733810059'],
            ['id' => 12, 'name' => 'Chainlink', 'symbol' => 'LINK', 'price' => '11.37', 'change' => '+3.39%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/877/large/Chainlink_Logo_500.png?1760023405'],
            ['id' => 70, 'name' => 'USD1', 'symbol' => 'USD1', 'price' => '1.00', 'change' => '+0.00%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/54977/large/USD1_1000x1000_transparent.png?1749297002'],
            ['id' => 61, 'name' => 'WhiteBIT Coin', 'symbol' => 'WBT', 'price' => '71.68', 'change' => '+1.87%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/27045/large/wbt_token.png?1696526096'],
            ['id' => 15, 'name' => 'Litecoin', 'symbol' => 'LTC', 'price' => '51.00', 'change' => '+4.69%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/2/large/litecoin.png?1696501400'],
            ['id' => 87, 'name' => 'Uniswap', 'symbol' => 'UNI', 'price' => '6.20', 'change' => '+6.37%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/12504/large/uniswap-logo.png?1720676669'],
            ['id' => 78, 'name' => 'Gram (prev. Toncoin)', 'symbol' => 'GRAM', 'price' => '1.33', 'change' => '+0.44%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/17980/large/Gram_Circular_Badge.png?1781524778'],
            ['id' => 8, 'name' => 'Cardano', 'symbol' => 'ADA', 'price' => '0.21', 'change' => '+7.09%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/975/large/cardano.png?1696502090'],
            ['id' => 73, 'name' => 'Hedera', 'symbol' => 'HBAR', 'price' => '0.08', 'change' => '+5.64%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/3688/large/hbar.png?1696504364'],
            ['id' => 5, 'name' => 'Solana', 'symbol' => 'SOL', 'price' => '101.17', 'change' => '+3.48%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/4128/large/solana.png?1718769756'],
            ['id' => 84, 'name' => 'Global Dollar', 'symbol' => 'USDG', 'price' => '1.00', 'change' => '+0.01%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/51281/large/GDN_USDG_Token_200x200.png?1730484111'],
            ['id' => 71, 'name' => 'Rain', 'symbol' => 'RAIN', 'price' => '0.02', 'change' => '-1.32%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/69134/large/Rain_logo_1_.png?1762952191'],
            ['id' => 13, 'name' => 'Avalanche', 'symbol' => 'AVAX', 'price' => '7.30', 'change' => '+2.68%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/12559/large/Avalanche_Circle_RedWhite_Trans.png?1696512369'],
            ['id' => 75, 'name' => 'Sui', 'symbol' => 'SUI', 'price' => '0.77', 'change' => '+7.89%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/26375/large/sui-ocean-square.png?1727791290'],
            ['id' => 77, 'name' => 'Shiba Inu', 'symbol' => 'SHIB', 'price' => '0.00', 'change' => '+2.30%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/11939/large/shiba.png?1696511800'],
            ['id' => 3, 'name' => 'Tether', 'symbol' => 'USDT', 'price' => '1.00', 'change' => '+0.01%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/325/large/Tether.png?1696501661'],
            ['id' => 74, 'name' => 'PayPal USD', 'symbol' => 'PYUSD', 'price' => '1.00', 'change' => '+0.02%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/31212/large/PYUSD_Token_Logo_2x.png?1765987788'],
            ['id' => 80, 'name' => 'Tether Gold', 'symbol' => 'XAUT', 'price' => '4,595.87', 'change' => '-0.38%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/10481/large/logo.png?1774627372'],
            ['id' => 79, 'name' => 'Cronos', 'symbol' => 'CRO', 'price' => '0.06', 'change' => '+1.07%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/7310/large/cro_token_logo.png?1696507599'],
            ['id' => 82, 'name' => 'MemeCore', 'symbol' => 'M', 'price' => '1.24', 'change' => '+9.50%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/53247/large/square-bg-transparent.png?1752637478'],
            ['id' => 2, 'name' => 'Ethereum', 'symbol' => 'ETH', 'price' => '2,416.60', 'change' => '+1.59%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/279/large/ethereum.png?1696501628'],
            ['id' => 85, 'name' => 'Circle USYC', 'symbol' => 'USYC', 'price' => '1.14', 'change' => '+0.03%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/51054/large/Hashnote_SDYC_200x200.png?1730370965'],
            ['id' => 86, 'name' => 'BlackRock USD Institutional Digital Liquidity Fund', 'symbol' => 'BUIDL', 'price' => '1.00', 'change' => '+0.00%', 'class' => 'crypto', 'img' => 'https://coin-images.coingecko.com/coins/images/36291/large/blackrock.png?1711013223'],
            ['id' => 11, 'name' => 'Polkadot', 'symbol' => 'DOT', 'price' => '', 'change' => '', 'class' => 'crypto', 'img' => 'https://assets.coingecko.com/coins/images/12171/large/polkadot.png'],
            ['id' => 14, 'name' => 'Polygon', 'symbol' => 'MATIC', 'price' => '', 'change' => '', 'class' => 'crypto', 'img' => 'https://assets.coingecko.com/coins/images/4713/large/polygon.png'],
            ['id' => 19, 'name' => 'Australian Dollar / US Dollar', 'symbol' => 'AUD/USD', 'price' => '0.71', 'change' => '-0.39%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/au.svg'],
            ['id' => 25, 'name' => 'British Pound / Japanese Yen', 'symbol' => 'GBP/JPY', 'price' => '212.86', 'change' => '-0.20%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/gb.svg'],
            ['id' => 17, 'name' => 'British Pound / US Dollar', 'symbol' => 'GBP/USD', 'price' => '1.34', 'change' => '-0.29%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/gb.svg'],
            ['id' => 23, 'name' => 'Euro / British Pound', 'symbol' => 'EUR/GBP', 'price' => '0.86', 'change' => '+0.02%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/eu.svg'],
            ['id' => 24, 'name' => 'Euro / Japanese Yen', 'symbol' => 'EUR/JPY', 'price' => '183.63', 'change' => '-0.18%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/eu.svg'],
            ['id' => 16, 'name' => 'Euro / US Dollar', 'symbol' => 'EUR/USD', 'price' => '1.15', 'change' => '-0.27%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/eu.svg'],
            ['id' => 26, 'name' => 'Gold Spot / US Dollar', 'symbol' => 'XAU/USD', 'price' => '5,145.76', 'change' => '-0.72%', 'class' => 'forex', 'img' => 'https://img.icons8.com/color/48/gold-bars.png'],
            ['id' => 21, 'name' => 'New Zealand Dollar / US Dollar', 'symbol' => 'NZD/USD', 'price' => '0.59', 'change' => '-0.42%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/nz.svg'],
            ['id' => 27, 'name' => 'Silver / US Dollar', 'symbol' => 'XAG/USD', 'price' => '24.82', 'change' => '+0.68%', 'class' => 'forex', 'img' => 'https://img.icons8.com/color/48/silver-bars.png'],
            ['id' => 22, 'name' => 'US Dollar / Canadian Dollar', 'symbol' => 'USD/CAD', 'price' => '1.36', 'change' => '+0.12%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/ca.svg'],
            ['id' => 18, 'name' => 'US Dollar / Japanese Yen', 'symbol' => 'USD/JPY', 'price' => '159.11', 'change' => '+0.10%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/us.svg'],
            ['id' => 20, 'name' => 'US Dollar / Swiss Franc', 'symbol' => 'USD/CHF', 'price' => '0.78', 'change' => '+0.29%', 'class' => 'forex', 'img' => 'https://hatscripts.github.io/circle-flags/flags/ch.svg'],
            ['id' => 30, 'name' => 'Alphabet Inc.', 'symbol' => 'GOOGL', 'price' => '308.70', 'change' => '+0.54%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/GOOG.png'],
            ['id' => 31, 'name' => 'Amazon.com, Inc.', 'symbol' => 'AMZN', 'price' => '212.65', 'change' => '-0.78%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AMZN.png'],
            ['id' => 28, 'name' => 'Apple Inc.', 'symbol' => 'AAPL', 'price' => '260.81', 'change' => '-0.01%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/AAPL.png'],
            ['id' => 40, 'name' => 'Boeing Company', 'symbol' => 'BA', 'price' => '188.92', 'change' => '-0.89%', 'class' => 'stock', 'img' => ''],
            ['id' => 37, 'name' => 'Intel Corporation', 'symbol' => 'INTC', 'price' => '42.31', 'change' => '-0.56%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/INTC.png'],
            ['id' => 41, 'name' => 'JPMorgan Chase & Co.', 'symbol' => 'JPM', 'price' => '198.37', 'change' => '+0.64%', 'class' => 'stock', 'img' => ''],
            ['id' => 34, 'name' => 'Meta Platforms Inc.', 'symbol' => 'META', 'price' => '502.18', 'change' => '+1.58%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/FB.png'],
            ['id' => 29, 'name' => 'Microsoft Corp.', 'symbol' => 'MSFT', 'price' => '404.88', 'change' => '-0.22%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/MSFT.png'],
            ['id' => 35, 'name' => 'Netflix Inc.', 'symbol' => 'NFLX', 'price' => '628.73', 'change' => '+0.45%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/NFLX.png'],
            ['id' => 33, 'name' => 'NVIDIA Corporation', 'symbol' => 'NVDA', 'price' => '878.35', 'change' => '+3.42%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/NVDA.png'],
            ['id' => 38, 'name' => 'PayPal Holdings', 'symbol' => 'PYPL', 'price' => '63.28', 'change' => '+0.72%', 'class' => 'stock', 'img' => ''],
            ['id' => 32, 'name' => 'Tesla Inc.', 'symbol' => 'TSLA', 'price' => '175.34', 'change' => '-2.15%', 'class' => 'stock', 'img' => 'https://static2.finnhub.io/file/publicdatany/finnhubimage/stock_logo/TSLA.png'],
            ['id' => 39, 'name' => 'Walt Disney Co.', 'symbol' => 'DIS', 'price' => '112.45', 'change' => '+0.31%', 'class' => 'stock', 'img' => ''],
            ['id' => 50, 'name' => 'ARK Innovation ETF', 'symbol' => 'ARKK', 'price' => '48.92', 'change' => '-1.85%', 'class' => 'etf', 'img' => ''],
            ['id' => 49, 'name' => 'Financial Select Sector SPDR Fund', 'symbol' => 'XLF', 'price' => '41.28', 'change' => '+0.62%', 'class' => 'etf', 'img' => ''],
            ['id' => 43, 'name' => 'Invesco QQQ Trust', 'symbol' => 'QQQ', 'price' => '442.87', 'change' => '+0.78%', 'class' => 'etf', 'img' => ''],
            ['id' => 48, 'name' => 'iShares 20+ Year Treasury Bond ETF', 'symbol' => 'TLT', 'price' => '92.34', 'change' => '+0.15%', 'class' => 'etf', 'img' => ''],
            ['id' => 46, 'name' => 'iShares MSCI Emerging Markets ETF', 'symbol' => 'EEM', 'price' => '42.73', 'change' => '-0.31%', 'class' => 'etf', 'img' => ''],
            ['id' => 44, 'name' => 'iShares Russell 2000 ETF', 'symbol' => 'IWM', 'price' => '207.56', 'change' => '-0.42%', 'class' => 'etf', 'img' => ''],
            ['id' => 51, 'name' => 'SPDR Dow Jones Industrial Average ETF', 'symbol' => 'DIA', 'price' => '393.67', 'change' => '+0.35%', 'class' => 'etf', 'img' => ''],
            ['id' => 47, 'name' => 'SPDR Gold Shares', 'symbol' => 'GLD', 'price' => '201.45', 'change' => '+0.38%', 'class' => 'etf', 'img' => ''],
            ['id' => 42, 'name' => 'SPDR S&P 500 ETF', 'symbol' => 'SPY', 'price' => '518.42', 'change' => '+0.53%', 'class' => 'etf', 'img' => ''],
            ['id' => 45, 'name' => 'Vanguard Total Stock Market ETF', 'symbol' => 'VTI', 'price' => '263.18', 'change' => '+0.48%', 'class' => 'etf', 'img' => ''],
            ['id' => 56, 'name' => 'DAX Performance Index', 'symbol' => 'DAX', 'price' => '17,932.68', 'change' => '+0.45%', 'class' => 'index', 'img' => ''],
            ['id' => 54, 'name' => 'Dow Jones Industrial Average', 'symbol' => 'DJI', 'price' => '39,170.35', 'change' => '+0.34%', 'class' => 'index', 'img' => ''],
            ['id' => 59, 'name' => 'EURO STOXX 50', 'symbol' => 'STOXX50E', 'price' => '4,982.76', 'change' => '+0.28%', 'class' => 'index', 'img' => ''],
            ['id' => 55, 'name' => 'FTSE 100', 'symbol' => 'FTSE', 'price' => '7,722.55', 'change' => '-0.18%', 'class' => 'index', 'img' => ''],
            ['id' => 58, 'name' => 'Hang Seng Index', 'symbol' => 'HSI', 'price' => '16,529.48', 'change' => '-0.73%', 'class' => 'index', 'img' => ''],
            ['id' => 53, 'name' => 'NASDAQ Composite', 'symbol' => 'IXIC', 'price' => '16,274.94', 'change' => '+0.82%', 'class' => 'index', 'img' => ''],
            ['id' => 57, 'name' => 'Nikkei 225', 'symbol' => 'N225', 'price' => '39,688.94', 'change' => '+1.12%', 'class' => 'index', 'img' => ''],
            ['id' => 52, 'name' => 'S&P 500', 'symbol' => 'SPX', 'price' => '5,175.27', 'change' => '+0.56%', 'class' => 'index', 'img' => ''],
        ];

        DB::table('markets')->insert(array_map(fn ($a) => [
            'id' => $a['id'],
            'name' => $a['name'],
            'symbol' => $a['symbol'],
            'class' => $a['class'],
            'price' => $a['price'] === '' ? null : $a['price'],
            'price_change' => $a['change'] === '' ? null : $a['change'],
            'img' => $a['img'],
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ], $assets));
    }

    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};