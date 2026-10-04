<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('signal_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_description')->nullable();
            $table->decimal('price', 18, 2);
            $table->unsignedInteger('duration')->comment('weeks');
            $table->text('benefits')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $benefits = ['General trading signals', 'High-accuracy signals with risk-reward ratios.', '24/7 Expert support'];
        $rows = [
            [2, 'Alpha Signals', 99, 1],
            [3, 'Titan Signals', 149, 2],
            [4, 'Quantum Edge Signals', 199, 3],
            [5, 'Elite Trader Signals', 249, 4],
            [6, 'Velocity Pro Signals', 299, 5],
            [7, 'Apex Master Signals', 399, 6],
            [8, 'Genesis Prime Signals', 499, 7],
            [9, 'Legendary Investor Plan', 999, 8],
        ];
        foreach ($rows as [$id, $name, $price, $duration]) {
            DB::table('signal_plans')->insert([
                'id' => $id,
                'name' => $name,
                'short_description' => 'Premium ' . strtolower($name),
                'price' => $price,
                'duration' => $duration,
                'benefits' => json_encode($benefits),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('signal_plans');
    }
};