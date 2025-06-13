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
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_hash', 64)->index(); // Zahaszowany adres IP dla zachowania prywatności
            $table->string('user_agent')->nullable();
            $table->string('url'); // Odwiedzona strona
            $table->string('referrer')->nullable(); // Strona odsyłająca
            $table->timestamp('visited_at'); // Czas odwiedzin
            $table->timestamps();
            
            // Indeksy dla poprawy wydajności zapytań
            $table->index('visited_at');
            $table->index('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
