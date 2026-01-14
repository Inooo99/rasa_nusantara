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
    Schema::create('recipes', function (Blueprint $table) {
        $table->id();
        $table->string('title');        // Judul: "Gudeg Yogya..."
        $table->string('slug')->unique(); // Untuk link URL
        $table->string('image');        // Link gambar
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');    // Kategori: "Resep", "Review", dll
        $table->text('description');    // Deskripsi singkat
        $table->text('content')->nullable(); // Isi resep lengkap
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
