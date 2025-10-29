<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar semua pengumuman.
     */
    public function index()
    {
        $dataPengumuman = Pengumuman::latest()->paginate(10);
        return view('backend.pages.pengumuman.index', compact('dataPengumuman'));
    }

    /**
     * Menampilkan form untuk membuat pengumuman baru.
     */
    public function create()
    {
        return view('backend.pages.engumuman.create');
    }

    /**
     * Menyimpan pengumuman baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_publikasi' => 'required|date',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/pengumuman');
            $validatedData['gambar'] = basename($path);
        }

        Pengumuman::create($validatedData);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit pengumuman.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('backend.pages.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Memperbarui data pengumuman di database.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_publikasi' => 'required|date',
        ]);

        if ($request->hasFile('gambar')) {
            if ($pengumuman->gambar) {
                Storage::delete('public/pengumuman/' . $pengumuman->gambar);
            }
            $path = $request->file('gambar')->store('public/pengumuman');
            $validatedData['gambar'] = basename($path);
        }

        $pengumuman->update($validatedData);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Menghapus pengumuman dari database.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->gambar) {
            Storage::delete('public/pengumuman/' . $pengumuman->gambar);
        }
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }
}