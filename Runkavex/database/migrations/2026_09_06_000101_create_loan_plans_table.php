<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('min_amount', 18, 2);
            $table->decimal('max_amount', 18, 2);
            $table->decimal('interest_rate', 8, 2);
            $table->string('interest_type')->default('simple');
            $table->unsignedInteger('min_duration')->default(1);
            $table->unsignedInteger('max_duration')->default(12);
            $table->decimal('processing_fee', 8, 2)->default(0);
            $table->decimal('min_account_balance', 18, 2)->default(0);
            $table->boolean('requires_collateral')->default(false);
            $table->decimal('collateral_percentage', 8, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('loan_plans')->insert([
            ['id' => 1, 'name' => 'Trading Margin Loan', 'description' => 'Short-term leverage for active traders. Higher amounts, lower rates, designed for quick market opportunities.', 'min_amount' => 5000, 'max_amount' => 500000, 'interest_rate' => 3.50, 'interest_type' => 'simple', 'min_duration' => 1, 'max_duration' => 12, 'processing_fee' => 0.50, 'min_account_balance' => 1000.00, 'requires_collateral' => false, 'collateral_percentage' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Personal Loan', 'description' => 'General-purpose loan for personal needs. Medium amounts with flexible terms.', 'min_amount' => 1000, 'max_amount' => 100000, 'interest_rate' => 8.00, 'interest_type' => 'compound', 'min_duration' => 3, 'max_duration' => 36, 'processing_fee' => 1.00, 'min_account_balance' => 500.00, 'requires_collateral' => false, 'collateral_percentage' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Business Expansion Loan', 'description' => 'Long-term financing for business growth and investment expansion.', 'min_amount' => 10000, 'max_amount' => 1000000, 'interest_rate' => 6.00, 'interest_type' => 'compound', 'min_duration' => 6, 'max_duration' => 60, 'processing_fee' => 1.50, 'min_account_balance' => 5000.00, 'requires_collateral' => true, 'collateral_percentage' => 10.00, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Quick Cash Loan', 'description' => 'Small, short-term loan for immediate needs. Fast approval, higher rate.', 'min_amount' => 100, 'max_amount' => 10000, 'interest_rate' => 12.00, 'interest_type' => 'simple', 'min_duration' => 1, 'max_duration' => 6, 'processing_fee' => 2.00, 'min_account_balance' => 0.00, 'requires_collateral' => false, 'collateral_percentage' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Portfolio Leverage Loan', 'description' => 'Leverage your trading portfolio with competitive rates. Designed for experienced investors.', 'min_amount' => 25000, 'max_amount' => 2000000, 'interest_rate' => 4.50, 'interest_type' => 'compound', 'min_duration' => 3, 'max_duration' => 24, 'processing_fee' => 0.75, 'min_account_balance' => 10000.00, 'requires_collateral' => true, 'collateral_percentage' => 15.00, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_plans');
    }
};