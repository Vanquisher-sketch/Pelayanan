@extends('backend.layouts.app')

{{-- Mengirimkan judul halaman ke layout --}}
@section('title', 'Data Layanan')

{{-- Konten utama halaman --}}
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Layanan</h1>
<p class="mb-4">Daftar semua layanan yang tersedia di Kecamatan Tawang. Anda dapat menambah, mengubah, atau menghapus data layanan dari tabel di bawah ini.</p>

<!-- Pesan Sukses -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Card Wrapper (Struktur khas SB Admin 2) -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Layanan</h6>
        <a href="{{ route('layanan.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Layanan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Layanan</th>
                        <th scope="col">Seksi Penanggung Jawab</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($layanans as $index => $layanan)
                        <tr>
                            {{-- Menggunakan helper pagination untuk penomoran --}}
                            <td>{{ $layanans->firstItem() + $index }}</td>
                            <td>{{ $layanan->nama_layanan }}</td>
                            <td>{{ $layanan->seksi->nama_seksi ?? 'N/A' }}</td>
                            <td>
                                {{-- Saya asumsikan nama route Anda 'admin.layanan.edit' agar konsisten --}}
                                <a href="{{ route('layanan.edit', $layanan->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- Saya asumsikan nama route Anda 'layanan.destroy' agar konsisten --}}
                                <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data layanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $layanans->links() }}
        </div>
    </div>
</div>
@endsection

