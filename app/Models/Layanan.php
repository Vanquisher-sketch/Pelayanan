<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// Impor model yang akan direlasikan
use App\Models\Seksi;
use App\Models\Permohonan;

class Layanan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Atribut yang bisa diisi.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'seksi_id',
        'nama_layanan',
        'deskripsi',
        'persyaratan', // Akan disimpan sebagai JSON
    ];

    /**
     * Tipe data cast otomatis.
     * Mengubah 'persyaratan' dari JSON (di DB) ke array (di PHP) & sebaliknya.
     * Ini sangat berguna untuk menyimpan daftar persyaratan.
     *
     * @var array
     */
    protected $casts = [
        'persyaratan' => 'array',
    ];

    /**
     * Relasi ke model Seksi.
     * Sebuah Layanan PASTI milik sebuah Seksi.
     * (Contoh: 'Izin Keramaian' -> 'Seksi Trantib')
     */
    public function seksi(): BelongsTo
    {
        // Pastikan Anda juga sudah membuat model Seksi.php
        return $this->belongsTo(Seksi::class);
    }

    /**
     * Relasi ke model Permohonan.
     * Sebuah Layanan BISA memiliki BANYAK Permohonan.
     */
    public function permohonans(): HasMany
    {
        return $this->hasMany(Permohonan::class);
    }
}
