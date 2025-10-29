<?php

namespace App\Http\Controllers;

use App\Models\Layanan; // Asumsi Anda punya model ini
use App\Models\Pengumuman;
use App\Models\Galeri;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // 1. Ambil data pengumuman terbaru (misalnya 6) dan beri penanda 'type'
        $pengumumans = Pengumuman::latest()->take(6)->get()->map(function ($item) {
            $item->type = 'Pengumuman';
            return $item;
        });

        // 2. Ambil data galeri terbaru (misalnya 6) dan beri penanda 'type'
        $galeris = Galeri::latest()->take(6)->get()->map(function ($item) {
            $item->type = 'Galeri';
            return $item;
        });

        // 3. Gabungkan kedua koleksi data
        $items = $pengumumans->merge($galeris);

        // 4. Urutkan gabungan data berdasarkan tanggal dibuat (yang paling baru di atas)
        $sortedItems = $items->sortByDesc('created_at');

        // 5. Ambil 6 item teratas setelah diurutkan
        $displayItems = $sortedItems->take(6);

        // 6. Ambil data layanan untuk form pengajuan (jika ada)
        // Pastikan Anda sudah punya model dan tabel 'Layanan'
        $layanans = Layanan::where('status', 'aktif')->get();

        // 7. Kirim semua data ke view
        return view('frontend.index', [
            'items' => $displayItems,
            'layanans' => $layanans
        ]);
    }
}