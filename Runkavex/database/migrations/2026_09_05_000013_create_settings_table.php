<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            ['key' => 'site_name', 'value' => 'Runkavex Capital', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'support_email', 'value' => 'support@runkavexcapital.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'company_address', 'value' => '1 Canada Square, London E14 5AB, United Kingdom', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};