<?php

// 1. Namespace diubah ke root Controllers
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use App\Models\DokumenPermohonan; // TAMBAHKAN INI
use App\Models\Layanan; // TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // TAMBAHKAN INI
use Illuminate\Support\Facades\Storage; // TAMBAHKAN INI
use Illuminate\Support\Str; // TAMBAHKAN INI
use Illuminate\Support\Facades\Log; // <-- INI PERBAIKANNYA


class PermohonanController extends Controller
{
    /**
     * Menampilkan halaman utama (tabel data permohonan).
     */
    public function index()
    {
        // Mengambil data permohonan dengan eager loading 'layanan' untuk efisiensi query
        $query = Permohonan::with('layanan');

        // // LOGIKA KUNCI: Filter permohonan berdasarkan seksi pengguna (DIHAPUS DARI KODE ASLI ANDA)
        // if (!$user->hasRole('super-admin')) {
        // ...
        // }
        
        // Sekarang, query ini akan mengambil SEMUA permohonan
        $permohonans = $query->latest()->paginate(10);

        return view('backend.pages.permohonan.index', compact('permohonans'));
    }

    /**
     * Menampilkan halaman detail satu permohonan.
     */
    public function show(Permohonan $permohonan)
    {
        // Eager load dokumen-dokumen yang terkait dengan permohonan ini
        $permohonan->load('dokumenPermohonans');
        
        return view('backend.pages.permohonan.show', compact('permohonan'));
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

        return redirect()->route('backend.pages.permohonan.show', $permohonan)->with('success', 'Status permohonan berhasil diperbarui!');
    }

    /**
     * Menghapus (soft delete) data permohonan.
     */
    public function destroy(Permohonan $permohonan)
    {
        $permohonan->delete();
        return redirect()->route('backend.pages.permohonan.index')->with('success', 'Permohonan berhasil dihapus.');
    }

    // --- METHOD BARU DIMULAI DI SINI ---

    /**
     * Method untuk menangani form pengajuan layanan dari frontend.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'nama_pemohon' => 'required|string|max:255',
            'nik_pemohon' => 'required|string|digits:16',
            'wa_pemohon' => 'required|string|max:15',
            'email_pemohon' => 'nullable|email',
            'berkas' => 'required|array|min:1', // Pastikan 'berkas' adalah array dan tidak kosong
            'berkas.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi setiap file
        ]);

        // 2. Gunakan Transaksi Database
        // Ini memastikan jika upload file gagal, data permohonan juga tidak akan tersimpan.
        try {
            DB::beginTransaction();

            // 3. Simpan data permohonan utama
            $permohonan = new Permohonan();
            $permohonan->layanan_id = $validated['layanan_id'];
            $permohonan->nama_pemohon = $validated['nama_pemohon'];
            $permohonan->nik_pemohon = $validated['nik_pemohon'];
            $permohonan->wa_pemohon = $validated['wa_pemohon'];
            $permohonan->email_pemohon = $validated['email_pemohon'];
            $permohonan->status = 'masuk'; // Status default saat pertama kali diajukan
            $permohonan->save(); // Simpan untuk mendapatkan ID

            // 4. Buat Nomor Tiket Unik (setelah disimpan)
            // Format: TWG-TAHUN-ID (contoh: TWG-2025-0012)
            $nomorTiket = 'TWG-' . date('Y') . '-' . str_pad($permohonan->id, 4, '0', STR_PAD_LEFT);
            $permohonan->nomor_tiket = $nomorTiket;
            $permohonan->save();

            // 5. Simpan file-file berkas
            if ($request->hasFile('berkas')) {
                foreach ($request->file('berkas') as $file) {
                    // Buat nama file unik: NIK-timestamp-nama_asli.ext
                    $namaFileAsli = $file->getClientOriginalName();
                    $namaFileUnik = $validated['nik_pemohon'] . '-' . time() . '-' . Str::slug(pathinfo($namaFileAsli, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    
                    // Simpan file ke storage (misal: storage/app/public/dokumen_permohonan/12)
                    // Angka 12 adalah ID permohonan
                    $path = $file->storeAs('public/dokumen_permohonan/' . $permohonan->id, $namaFileUnik);

                    // Simpan path ke database dokumen
                    DokumenPermohonan::create([
                        'permohonan_id' => $permohonan->id,
                        'nama_file' => $namaFileAsli, // Simpan nama asli untuk ditampilkan
                        'path_file' => $path, // Simpan path di storage
                    ]);
                }
            }

            // 6. Jika semua berhasil, commit transaksi
            DB::commit();

            // 7. Kembalikan ke halaman depan dengan pesan sukses dan nomor tiket
            return redirect('/#ajukan-layanan')
                ->with('success', 'Permohonan Anda berhasil dikirim!')
                ->with('nomor_tiket', $nomorTiket);

        } catch (\Exception $e) {
            // 8. Jika ada error, batalkan semua (rollback) dan kembali dengan pesan error
            DB::rollBack();

            // Log error untuk developer
            Log::error('Gagal menyimpan permohonan: ' . $e->getMessage()); // <-- Tanda '\' di depan Log juga dihapus

            return redirect('/#ajukan-layanan')
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Method untuk menangani form Lacak Berkas dari frontend.
     */
    public function lacak(Request $request)
    {
        $request->validate([
            'nomor_tiket' => 'required|string',
        ]);

        $nomorTiket = $request->input('nomor_tiket');
        $permohonan = Permohonan::where('nomor_tiket', $nomorTiket)->first();

        if ($permohonan) {
            // Jika ditemukan, kirim data permohonan ke view
            return redirect('/#lacak-layanan')->with('status_lacak', $permohonan);
        } else {
            // Jika tidak ditemukan
            return redirect('/#lacak-layanan')->with('status_error', 'Nomor tiket tidak ditemukan.');
        }
    }
}


