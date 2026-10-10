<?php
/* Developer: Olha Rosolovska */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ad_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_placement_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('advertiser');
            $table->string('media_url')->nullable();
            $table->string('target_url')->nullable();
            $table->decimal('budget', 12, 2)->default(0);
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
            $table->enum('status', ['pending', 'active', 'paused', 'completed'])->default('pending');
            $table->unsignedBigInteger('impressions')->default(0);
            $table->unsignedBigInteger('clicks')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ad_campaigns'); }
};
