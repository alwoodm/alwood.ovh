<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->default('Portfolio'); // Tytuł strony
            $table->string('site_description', 500)->nullable(); // Meta opis strony
            $table->string('site_keywords', 500)->nullable(); // Meta słowa kluczowe
            $table->string('favicon_path')->nullable(); // Ścieżka do ikony strony
            $table->string('og_image_path')->nullable(); // Obraz dla Open Graph
            $table->string('twitter_image_path')->nullable(); // Obraz dla Twitter Cards
            $table->string('google_analytics_id')->nullable(); // ID Google Analytics
            $table->boolean('use_site_name_in_title')->default(true); // Czy dodawać nazwę strony do tytułów podstron
            $table->string('title_separator')->default(' - '); // Separator w tytule podstron
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
