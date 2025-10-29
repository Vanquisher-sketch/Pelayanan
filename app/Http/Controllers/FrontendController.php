<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage)
     * dan mengirimkan data yang diperlukan ke view.
     */
    public function index()
    {
        // Ambil semua layanan yang aktif dari database
        $layanans = Layanan::orderBy('nama_layanan', 'asc')->get();
        
        // Tampilkan view frontend dan kirim data 'layanans'
        return view('frontend.index', compact('layanans'));
    }
}
