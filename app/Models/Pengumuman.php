<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    /**
     * INI KUNCINYA: Memberitahu Laravel untuk menggunakan tabel bernama 'pengumumen'.
     */
    protected $table = 'pengumumen';

    /**
     * Properti yang boleh diisi secara massal.
     */
    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tanggal_publikasi',
    ];
}