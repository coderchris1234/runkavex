<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('trading_asset_id');
            $table->string('symbol');
            $table->string('name');
            $table->string('asset_class')->default('crypto');
            $table->string('trade_type')->default('binary');
            $table->string('action');
            $table->decimal('amount', 18, 2);
            $table->unsignedInteger('leverage');
            $table->decimal('entry_price', 18, 8);
            $table->unsignedInteger('duration')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->string('status')->default('open');
            $table->string('result')->default('pending');
            $table->decimal('pnl', 18, 2)->default(0);
            $table->boolean('is_demo')->default(false);
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};