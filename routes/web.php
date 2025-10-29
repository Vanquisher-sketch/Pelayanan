<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PermohonanController;
// Impor Controller Admin Anda di sini



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda mendaftarkan rute web untuk aplikasi Anda.
|
*/

// ======================================================================
// RUTE UNTUK FRONTEND (HALAMAN WARGA)
// ======================================================================

// Contoh Rute Halaman Depan (Homepage)
Route::get('/', function () {
    return view('frontend.beranda'); // Ganti dengan view beranda Anda
})->name('beranda');

Route::get('/dashboard', function () {
        return view('backend.pages.dashboard');
    })->name('dashboard');

Route::resource('permohonan', PermohonanController::class);

// Tampilkan halaman utama (index.blade.php) dan kirim data layanan
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

// Tangani pengiriman form pengajuan layanan
Route::post('/ajukan-permohonan', [PermohonanController::class, 'store'])->name('permohonan.store');

// Tangani form pelacakan berkas
Route::get('/lacak-berkas', [PermohonanController::class, 'lacak'])->name('permohonan.lacak');

Route::resource('layanan', LayananController::class);

