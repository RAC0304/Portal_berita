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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->string('judul'); // Kolom judul berita
            $table->text('isi'); // Kolom isi berita
            $table->string('penulis'); // Kolom penulis berita
            $table->string('gambar')->nullable(); // Kolom gambar (bisa NULL)
            $table->string('kategori')->default('Nasional'); // Kolom kategori dengan default 'Nasional'
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas'); // Menghapus tabel beritas saat rollback
    }
};