<?php
/* Developer: Olha Rosolovska */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('synopsis')->nullable();
            $table->string('poster_url')->nullable();
            $table->string('backdrop_url')->nullable();
            $table->string('trailer_url')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('release_year')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->string('rating', 20)->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->enum('type', ['movie', 'series'])->default('movie');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('featured')->default(false);
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
        Schema::create('genre_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('genre_movie'); Schema::dropIfExists('movies'); }
};
