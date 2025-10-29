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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();

            // Kolom KUNCI untuk routing: layanan ini milik seksi mana?
            // Pastikan Anda sudah memiliki tabel 'seksis'
            $table->foreignId('seksi_id')->constrained('seksis')->onDelete('cascade');

            $table->string('nama_layanan');
            $table->text('deskripsi')->nullable();
            
            // ✅ REVISI: Menambahkan kolom 'status' untuk mengontrol visibilitas layanan
            $table->string('status', 20)->default('aktif');
            
            // Menyimpan daftar persyaratan dalam format JSON
            // Contoh: ["Scan KTP", "Scan KK", "Surat Pengantar RT/RW"]
            $table->json('persyaratan')->nullable();
            
            $table->timestamps();
            $table->softDeletes(); // Sesuai dengan model yang menggunakan SoftDeletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};