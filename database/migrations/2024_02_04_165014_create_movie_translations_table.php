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
        Schema::create('movie_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Movie::class);
            $table->string('title')->index();
            $table->string('language',4)->default('en')->index();
            $table->year('release_year');
            $table->text('poster')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_translations');
    }
};
