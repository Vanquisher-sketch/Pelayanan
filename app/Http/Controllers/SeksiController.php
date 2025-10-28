<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seksi;
use Illuminate\Http\Request;

class SeksiController extends Controller
{
    /**
     * Menampilkan halaman utama (tabel data seksi).
     */
    public function index()
    {
        $seksis = Seksi::latest()->paginate(10);
        return view('admin.seksi.index', compact('seksis'));
    }

    /**
     * Menampilkan form untuk membuat seksi baru.
     */
    public function create()
    {
        return view('admin.seksi.create');
    }

    /**
     * Menyimpan seksi baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_seksi' => 'required|string|max:255|unique:seksis',
            'deskripsi' => 'nullable|string',
        ]);

        Seksi::create($validatedData);

        return redirect()->route('admin.seksi.index')->with('success', 'Seksi baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu seksi.
     */
    public function show(Seksi $seksi)
    {
        // Biasanya halaman show/detail tidak terlalu diperlukan di admin panel sederhana,
        // seringkali langsung ke halaman edit. Tapi kita sediakan jika perlu.
        return view('admin.seksi.show', compact('seksi'));
    }

    /**
     * Menampilkan form untuk mengedit seksi.
     */
    public function edit(Seksi $seksi)
    {
        return view('admin.seksi.edit', compact('seksi'));
    }

    /**
     * Mengupdate data seksi di database.
     */
    public function update(Request $request, Seksi $seksi)
    {
        $validatedData = $request->validate([
            'nama_seksi' => 'required|string|max:255|unique:seksis,nama_seksi,' . $seksi->id,
            'deskripsi' => 'nullable|string',
        ]);

        $seksi->update($validatedData);

        return redirect()->route('admin.seksi.index')->with('success', 'Seksi berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) data seksi.
     */
    public function destroy(Seksi $seksi)
    {
        $seksi->delete();
        return redirect()->route('admin.seksi.index')->with('success', 'Seksi berhasil dihapus.');
    }
}
