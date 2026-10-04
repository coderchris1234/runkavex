<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('stock_id');
            $table->string('symbol', 10);
            $table->string('company_name');
            $table->string('type', 10);
            $table->decimal('shares', 20, 6);
            $table->decimal('price', 20, 2);
            $table->decimal('amount', 20, 2);
            $table->string('status', 20)->default('filled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_trades');
    }
};