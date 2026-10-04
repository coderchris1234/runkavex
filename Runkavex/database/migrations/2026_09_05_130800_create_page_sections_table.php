<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title');
            $table->string('page');
            $table->longText('content')->nullable();
            $table->timestamps();
        });

        $sections = [
            ['key' => 'home_hero_title', 'title' => 'Home Hero Title', 'page' => 'Home'],
            ['key' => 'home_hero_subtitle', 'title' => 'Home Hero Subtitle', 'page' => 'Home'],
            ['key' => 'about_text', 'title' => 'About Us Text', 'page' => 'About'],
            ['key' => 'contact_address', 'title' => 'Contact Address', 'page' => 'Contact'],
            ['key' => 'news_announcement', 'title' => 'News Announcement Banner', 'page' => 'News'],
        ];

        foreach ($sections as $section) {
            DB::table('page_sections')->insert(array_merge($section, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};