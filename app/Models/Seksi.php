<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// Impor model yang akan direlasikan
use App\Models\Layanan;
use App\Models\User;

class Seksi extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Atribut yang bisa diisi.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_seksi',
        'deskripsi',
    ];

    /**
     * Relasi ke model Layanan.
     * Satu Seksi bisa mengurus BANYAK Layanan.
     */
    public function layanans(): HasMany
    {
        return $this->hasMany(Layanan::class);
    }

    /**
     * Relasi ke model User.
     * Satu Seksi bisa memiliki BANYAK User (pegawai).
     */
    public function users(): HasMany
    {
        // Pastikan Anda menambahkan kolom 'seksi_id' di tabel 'users' Anda
        return $this->hasMany(User::class);
    }
}
