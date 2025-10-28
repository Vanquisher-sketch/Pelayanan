<?php

use Illuminate\Support\Facades\Route;
// Impor Controller Admin Anda di sini
use App\Http\Controllers\Admin\SeksiController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PermohonanController;
// ... (dan controller admin lainnya)

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

// Rute untuk halaman Lacak Permohonan, dll.
// Route::get('/lacak', [PageController::class, 'lacak'])->name('lacak');


// ======================================================================
// RUTE UNTUK BACKEND (HALAMAN ADMIN)
// ======================================================================

// Grup ini akan otomatis menambahkan prefix 'admin' ke URL (cth: /admin/dashboard)
// dan prefix 'admin.' ke nama rute (cth: route('admin.dashboard'))
Route::prefix('admin')->name('admin.')->group(function () {

    // Rute Dashboard Admin (yang Anda berikan)
    // INI YANG DIPERBAIKI: Route.get -> Route::get
    Route::get('/dashboard', function () {
        return view('backend.pages.dashboard');
    })->name('dashboard');

    // Rute untuk Manajemen Seksi
    // Ini akan otomatis membuat semua rute yang diperlukan untuk SeksiController:
    // - GET /admin/seksi -> SeksiController@index (admin.seksi.index)
    // - GET /admin/seksi/create -> SeksiController@create (admin.seksi.create)
    // - POST /admin/seksi -> SeksiController@store (admin.seksi.store)
    // - GET /admin/seksi/{seksi} -> SeksiController@show (admin.seksi.show)
    // - GET /admin/seksi/{seksi}/edit -> SeksiController@edit (admin.seksi.edit)
    // - PUT/PATCH /admin/seksi/{seksi} -> SeksiController@update (admin.seksi.update)
    // - DELETE /admin/seksi/{seksi} -> SeksiController@destroy (admin.seksi.destroy)
    Route::resource('seksi', SeksiController::class);
    
    // (Tambahkan resource controller Anda yang lain di sini)
    // Route::resource('layanan', LayananController::class);
    // Route::resource('permohonan', PermohonanController::class);
    // ... dan seterusnya
});

