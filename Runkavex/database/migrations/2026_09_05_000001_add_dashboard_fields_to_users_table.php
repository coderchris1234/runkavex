<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('gender', 20)->nullable()->after('phone');
            $table->string('country', 100)->nullable()->after('gender');
            $table->string('currency_code', 10)->default('USD')->after('country');
            $table->decimal('balance', 20, 2)->default(0)->after('currency_code');
            $table->decimal('total_profit', 20, 2)->default(0)->after('balance');
            $table->decimal('bonus', 20, 2)->default(0)->after('total_profit');
            $table->decimal('referral_bonus', 20, 2)->default(0)->after('bonus');
            $table->decimal('total_withdrawal', 20, 2)->default(0)->after('referral_bonus');
            $table->string('referral_code', 20)->unique()->nullable()->after('total_withdrawal');
            $table->unsignedBigInteger('referrer_id')->nullable()->after('referral_code');
            $table->foreign('referrer_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['referrer_id']);
            $table->dropColumn([
                'username', 'phone', 'gender', 'country', 'currency_code',
                'balance', 'total_profit', 'bonus', 'referral_bonus', 'total_withdrawal',
                'referral_code', 'referrer_id',
            ]);
        });
    }
};