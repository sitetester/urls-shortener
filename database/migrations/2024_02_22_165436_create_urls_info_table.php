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
        Schema::create('urls_info', function (Blueprint $table) {
            $table->id();
            $table->string('longUrl');
            $table->string('longUrlHash');
            $table->string('shortUrl');

            $table->index('longUrlHash');
            $table->index('shortUrl');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls_info');
    }
};
