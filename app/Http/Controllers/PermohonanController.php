<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; // Dihapus karena tidak digunakan

class PermohonanController extends Controller
{
    /**
     * Menampilkan halaman utama (tabel data permohonan).
     */
    public function index()
    {
        // $user = Auth::user(); // Dihapus

        // Mengambil data permohonan dengan eager loading 'layanan' untuk efisiensi query
        $query = Permohonan::with('layanan');

        // // LOGIKA KUNCI: Filter permohonan berdasarkan seksi pengguna (DIHAPUS)
        // if (!$user->hasRole('super-admin')) {
        //     // 1. Dapatkan ID seksi dari user yang login
        //     $seksi_id = $user->seksi_id;
        //     
        //     // 2. Filter permohonan dimana relasi 'layanan' memiliki 'seksi_id' yang sama
        //     $query->whereHas('layanan', function ($q) use ($seksi_id) {
        //         $q->where('seksi_id', $seksi_id);
        //     });
        // }
        
        // Sekarang, query ini akan mengambil SEMUA permohonan
        $permohonans = $query->latest()->paginate(10);

        return view('admin.permohonan.index', compact('permohonans'));
    }

    /**
     * Menampilkan halaman detail satu permohonan.
     */
    public function show(Permohonan $permohonan)
    {
        // Eager load dokumen-dokumen yang terkait dengan permohonan ini
        $permohonan->load('dokumenPermohonans');
        
        return view('admin.permohonan.show', compact('permohonan'));
    }
    
    /**
     * Method untuk mengupdate status permohonan dari halaman detail.
     */
    public function update(Request $request, Permohonan $permohonan)
    {
        $request->validate([
            'status' => 'required|in:sedang_diproses,butuh_revisi,selesai_siap_diambil,telah_diambil,ditolak',
            'keterangan_revisi' => 'required_if:status,butuh_revisi', // Wajib diisi jika statusnya 'butuh_revisi'
        ]);

        // Update data permohonan
        $permohonan->status = $request->status;
        if ($request->status == 'butuh_revisi') {
            $permohonan->keterangan_revisi = $request->keterangan_revisi;
        } else {
            $permohonan->keterangan_revisi = null; // Kosongkan jika status bukan revisi
        }
        $permohonan->save();

        // TODO: Kirim notifikasi ke warga (Email/WhatsApp) mengenai perubahan status ini.
        // event(new PermohonanStatusDiubah($permohonan));

        return redirect()->route('admin.permohonan.show', $permohonan)->with('success', 'Status permohonan berhasil diperbarui!');
    }

    /**
     * Menghapus (soft delete) data permohonan.
     */
    public function destroy(Permohonan $permohonan)
    {
        $permohonan->delete();
        return redirect()->route('admin.permohonan.index')->with('success', 'Permohonan berhasil dihapus.');
    }
}
