<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('reference', 30)->unique();
            $table->string('plan_name');
            $table->decimal('amount', 15, 2);
            $table->unsignedInteger('duration');
            $table->decimal('interest_rate', 5, 2);
            $table->string('interest_type', 10)->default('simple');
            $table->decimal('processing_fee', 5, 2)->default(0);
            $table->decimal('total_interest', 15, 2)->default(0);
            $table->decimal('processing_fee_amount', 15, 2)->default(0);
            $table->decimal('total_repayable', 15, 2)->default(0);
            $table->decimal('monthly_payment', 15, 2)->default(0);
            $table->string('purpose')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};