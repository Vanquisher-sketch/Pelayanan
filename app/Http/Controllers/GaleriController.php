<?php

namespace App\Http\Controllers;

use App\Models\Galeri; // <-- PENTING: Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- PENTING: Tambahkan ini

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar semua foto galeri.
     */
    public function index()
    {
        $dataGaleri = Galeri::latest()->paginate(12);
        return view('backend.pages.galeri.index', compact('dataGaleri'));
    }

    /**
     * Menampilkan form untuk menambah foto baru.
     */
    public function create()
    {
        return view('backend.pages.galeri.create');
    }

    /**
     * Menyimpan foto baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul_foto' => 'required|string|max:255',
            'deskripsi_foto' => 'nullable|string',
            'path_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('path_foto')) {
            $path = $request->file('path_foto')->store('public/galeri');
            $validatedData['path_foto'] = basename($path);
        }

        Galeri::create($validatedData);

        return redirect()->route('galeri.index')->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }
    
    /**
     * Menghapus foto dari galeri.
     */
    public function destroy(Galeri $galeri)
    {
        if ($galeri->path_foto) {
            Storage::delete('public/galeri/' . $galeri->path_foto);
        }
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Foto berhasil dihapus dari galeri!');
    }
}