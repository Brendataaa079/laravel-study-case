<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasis', function (Blueprint $table) {
            $table->id();
            // admin yang membuat informasi; ikut terhapus jika akun dihapus
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul', 150);
            $table->string('kategori', 50);                  // Akademik, Umum, Kegiatan
            $table->text('isi');
            $table->date('tanggal_publikasi');
            $table->string('status', 10)->default('draft');  // aktif, draft, arsip
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasis');
    }
};