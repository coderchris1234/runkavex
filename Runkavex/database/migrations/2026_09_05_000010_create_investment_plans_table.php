<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('min_amount', 18, 2);
            $table->decimal('max_amount', 18, 2)->nullable();
            $table->decimal('interest_rate', 8, 2)->comment('percent over duration');
            $table->unsignedInteger('duration')->comment('days');
            $table->string('color')->default('#16C79A');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('investment_plans')->insert([
            ['name' => 'Starter Plan', 'min_amount' => 100, 'max_amount' => 999, 'interest_rate' => 5, 'duration' => 7, 'color' => '#16C79A', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Silver Plan', 'min_amount' => 1000, 'max_amount' => 4999, 'interest_rate' => 8, 'duration' => 14, 'color' => '#94A3B8', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gold Plan', 'min_amount' => 5000, 'max_amount' => 19999, 'interest_rate' => 12, 'duration' => 21, 'color' => '#F59E0B', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Platinum Plan', 'min_amount' => 20000, 'max_amount' => null, 'interest_rate' => 16, 'duration' => 30, 'color' => '#3B82F6', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('investment_plans');
    }
};