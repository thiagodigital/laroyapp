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
        Schema::create('media', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');

            // Permite mídia sem post (ex: foto de perfil) ou com post
            $table->foreignUuid('post_id')->nullable()->constrained('posts')->onDelete('set null');

            $table->string('path'); // Caminho no disco (ex: uploads/user_1/file.mp4)
            $table->string('mime_type', 100);
            $table->enum('type', ['image', 'video', 'audio', 'other']);
            $table->unsignedBigInteger('size'); // Tamanho em bytes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
