@extends('backend.layouts.app') {{-- Sesuaikan dengan nama layout admin Anda --}}

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Permohonan Layanan</h1>
    </div>

    <!-- Peringatan Sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Card untuk Tabel Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Permohonan Masuk</h6>
            {{-- TODO: Tambahkan Form Filter di sini (berdasarkan status, tanggal, dll) --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No. Tiket</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Layanan</th>
                            <th>Tgl. Masuk</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permohonans as $item)
                            <tr>
                                <td>
                                    <span class="font-weight-bold">{{ $item->nomor_tiket }}</span>
                                </td>
                                <td>{{ $item->nama_pemohon }}</td>
                                <td>{{ $item->layanan->nama_layanan }}</td>
                                <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    {{-- Memberi warna status agar mudah dilihat --}}
                                    @if ($item->status == 'menunggu_verifikasi')
                                        <span class="badge badge-warning">Menunggu Verifikasi</span>
                                    @elseif ($item->status == 'sedang_diproses')
                                        <span class="badge badge-info">Sedang Diproses</span>
                                    @elseif ($item->status == 'butuh_revisi')
                                        <span class="badge badge-danger">Butuh Revisi</span>
                                    @elseif ($item->status == 'selesai_siap_diambil')
                                        <span class="badge badge-success">Selesai (Siap Diambil)</span>
                                    @elseif ($item->status == 'telah_diambil')
                                        <span class="badge badge-secondary">Telah Diambil</span>
                                    @elseif ($item->status == 'ditolak')
                                        <span class="badge badge-dark">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.permohonan.show', $item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    {{-- Tombol Hapus (Soft Delete) --}}
                                    <form action="{{ route('admin.permohonan.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus permohonan ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data permohonan tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tautan Paginasi -->
            <div class="d-flex justify-content-center">
                {{ $permohonans->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
