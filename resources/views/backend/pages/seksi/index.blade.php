@extends('backend.layouts.app')

{{-- Mengirimkan judul halaman ke layout --}}
@section('title', 'Data Seksi')

{{-- Konten utama halaman --}}
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Seksi</h1>
<p class="mb-4">Daftar semua seksi penanggung jawab di Kecamatan Tawang.</p>

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
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Seksi</h6>
        <a href="{{ route('seksi.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Seksi
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Seksi</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($seksis as $index => $seksi)
                        <tr>
                            <td>{{ $seksis->firstItem() + $index }}</td>
                            <td>{{ $seksi->nama_seksi }}</td>
                            <td>{{ $seksi->deskripsi ?? '-' }}</td>
                            <td>
                                <a href="{{ route('seksi.edit', $seksi->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('seksi.destroy', $seksi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus seksi ini? Menghapus seksi dapat mempengaruhi data layanan terkait.');">
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
                            <td colspan="4" class="text-center">Belum ada data seksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-3">
            {{ $seksis->links() }}
        </div>
    </div>
</div>
@endsection
