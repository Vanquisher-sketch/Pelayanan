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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();

            // Kolom untuk menghubungkan ke layanan mana permohonan ini ditujukan
            $table->foreignId('layanan_id')->constrained('layanans')->onDelete('cascade');

            // --- Data Pemohon (Karena Warga tidak login) ---
            $table->string('nama_pemohon');
            $table->string('nik_pemohon', 16);
            $table->string('wa_pemohon', 15);
            $table->string('email_pemohon')->nullable();

            // --- Data Tracking & Status ---
            $table->string('nomor_tiket')->unique();
            $table->enum('status', [
                'menunggu_verifikasi',
                'sedang_diproses',
                'butuh_revisi',
                'selesai_siap_diambil',
                'telah_diambil',
                'ditolak'
            ])->default('menunggu_verifikasi');
            
            $table->text('keterangan_revisi')->nullable(); // Diisi jika status 'butuh_revisi'

            $table->timestamps();
            $table->softDeletes(); // Untuk fitur arsip/hapus sementara
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};