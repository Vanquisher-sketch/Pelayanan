<?php

// Namespace diubah ke root App\Http\Controllers
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Seksi; // Dibutuhkan untuk dropdown form
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Menampilkan halaman utama (tabel data layanan).
     */
    public function index()
    {
        // Ambil semua layanan, eager load relasi 'seksi' untuk tampilkan nama seksi di tabel
        $layanans = Layanan::with('seksi')->latest()->paginate(10);
        
        // Catatan: Path view 'backend.pages.layanan.index' tetap dipertahankan
        // karena view Anda kemungkinan masih ada di folder resources/views/admin/layanan
        return view('backend.pages.layanan.index', compact('layanans'));
    }

    /**
     * Menampilkan form untuk membuat layanan baru.
     */
    public function create()
    {
        // Ambil semua data seksi untuk ditampilkan di form dropdown
        $seksis = Seksi::all();
        return view('backend.pages.layanan.create', compact('seksis'));
    }

    /**
     * Menyimpan layanan baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'seksi_id' => 'required|exists:seksis,id',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|array', // Pastikan input 'persyaratan' adalah array
        ]);

        Layanan::create($validatedData);

        // Catatan: Nama rute 'backend.pages.layanan.index' tetap dipertahankan
        // Anda hanya perlu mengubah definisi rute ini di routes/web.php
        return redirect()->route('layanan.index')->with('success', 'Layanan baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu layanan (opsional, seringkali langsung ke edit).
     */
    public function show(Layanan $layanan)
    {
         // Anda bisa arahkan ini ke view 'show' atau langsung ke 'edit'
         $seksis = Seksi::all(); // Diperlukan jika view show punya tombol 'edit'
         return view('backend.pages.layanan.show', compact('layanan', 'seksis'));
    }

    /**
     * Menampilkan form untuk mengedit layanan.
     */
    public function edit(Layanan $layanan)
    {
        $seksis = Seksi::all();
        return view('backend.pages.layanan.edit', compact('layanan', 'seksis'));
    }

    /**
     * Mengupdate data layanan di database.
     */
    public function update(Request $request, Layanan $layanan)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'seksi_id' => 'required|exists:seksis,id',
            'deskripsi' => 'nullable|string',
            'persyaratan' => 'nullable|array',
        ]);

        $layanan->update($validatedData);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) layanan dari database.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
