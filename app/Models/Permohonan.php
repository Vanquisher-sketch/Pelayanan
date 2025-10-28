<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Layanan;
use App\Models\DokumenPermohonan;

class Permohonan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Atribut yang bisa diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'layanan_id',
        'nama_pemohon',
        'nik_pemohon',
        'wa_pemohon',
        'email_pemohon',
        'nomor_tiket',
        'status',
        'keterangan_revisi',
    ];

    /**
     * Relasi ke model Layanan.
     * Sebuah Permohonan PASTI milik sebuah Layanan.
     */
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    /**
     * Relasi ke model DokumenPermohonan.
     * Sebuah Permohonan BISA memiliki BANYAK Dokumen.
     * (Anda perlu membuat model DokumenPermohonan nanti)
     */
    public function dokumenPermohonans(): HasMany
    {
        return $this->hasMany(DokumenPermohonan::class);
    }
}