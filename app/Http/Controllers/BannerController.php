<?php

namespace App\Http\Controllers;

use App\Models\Banner; // <-- PENTING: Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- PENTING: Tambahkan ini

class BannerController extends Controller
{
    /**
     * Menampilkan daftar semua banner.
     */
    public function index()
    {
        $dataBanner = Banner::latest()->get();
        return view('backend.pages.banner.index', compact('dataBanner'));
    }

    /**
     * Menampilkan form untuk menambah banner baru.
     */
    public function create()
    {
        return view('backend.pages.banner.create');
    }
    
    /**
     * Menyimpan banner baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul_banner' => 'required|string|max:255',
            'link_banner' => 'nullable|url',
            'path_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('path_banner')) {
            $path = $request->file('path_banner')->store('public/banner');
            $validatedData['path_banner'] = basename($path);
        }

        Banner::create($validatedData);

        return redirect()->route('banner.index')->with('success', 'Banner berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit banner.
     */
    public function edit(Banner $banner)
    {
        return view('backend.pages.banner.edit', compact('banner'));
    }

    /**
     * Memperbarui data banner di database.
     */
    public function update(Request $request, Banner $banner)
    {
        $validatedData = $request->validate([
            'judul_banner' => 'required|string|max:255',
            'link_banner' => 'nullable|url',
            'path_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('path_banner')) {
            if ($banner->path_banner) {
                Storage::delete('public/banner/' . $banner->path_banner);
            }
            $path = $request->file('path_banner')->store('public/banner');
            $validatedData['path_banner'] = basename($path);
        }

        $banner->update($validatedData);

        return redirect()->route('banner.index')->with('success', 'Banner berhasil diperbarui!');
    }

    /**
     * Menghapus banner.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->path_banner) {
            Storage::delete('public/banner/' . $banner->path_banner);
        }
        $banner->delete();
        
        return redirect()->route('banner.index')->with('success', 'Banner berhasil dihapus!');
    }
}