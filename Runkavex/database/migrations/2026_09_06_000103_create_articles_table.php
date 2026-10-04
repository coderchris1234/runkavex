<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt')->nullable();
            $table->longText('body');
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        DB::table('articles')->insert([
            [
                'title' => 'Bitcoin Climbs Past $78k as Institutions Accelerate Accumulation',
                'slug' => 'bitcoin-climbs-past-78k',
                'excerpt' => 'Fresh inflows into spot products and resilient on-chain activity push the market leader to a new high for the year.',
                'body' => "<p>Bitcoin has surged beyond the \$78,000 mark, extending a multi-week rally as institutional investors pour fresh capital into the asset.</p><p>Analysts point to improving liquidity conditions and growing adoption by corporate treasuries as the key drivers behind the latest move.</p><p>While short-term volatility persists, long-term holders continue to accumulate, keeping supply tight across major venues.</p>",
                'image' => null,
                'author' => 'Market Desk',
                'is_published' => true,
                'published_at' => now()->subDays(1),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'title' => 'How to Build a Diversified Crypto and Forex Portfolio',
                'slug' => 'build-a-diversified-portfolio',
                'excerpt' => 'A practical guide to balancing digital assets and major currency pairs to manage risk while pursuing growth.',
                'body' => "<p>Diversification remains one of the most reliable ways to manage risk in any trading portfolio.</p><p>Combining large-cap cryptocurrencies with major forex pairs can help smooth returns, since the two asset classes are driven by different market forces.</p><p>Before allocating capital, define your risk tolerance and always size positions conservatively.</p>",
                'image' => null,
                'author' => 'Education Team',
                'is_published' => true,
                'published_at' => now()->subDays(4),
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'title' => 'Runkavex Capital Expands Access to Global Equity Markets',
                'slug' => 'runkavex-expands-global-equity-access',
                'excerpt' => 'Traders can now access major US equities and ETFs directly from a single dashboard.',
                'body' => "<p>We are delighted to announce expanded access to global equity markets through our trading platform.</p><p>Clients can now trade a growing selection of US stocks and ETFs alongside their digital asset positions, all from one account.</p><p>This update is part of our continued commitment to providing a comprehensive, single-dashboard trading experience.</p>",
                'image' => null,
                'author' => 'Runkavex Capital',
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};