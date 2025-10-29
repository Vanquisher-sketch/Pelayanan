@extends('backend.layouts.app')

{{-- Mengirimkan judul halaman ke layout --}}
@section('title', 'Tambah Seksi Baru')

{{-- Konten utama halaman --}}
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah Seksi Baru</h1>

<!-- Menampilkan Error Validasi -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Seksi</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('seksi.store') }}" method="POST">
            @csrf
            
            <!-- Nama Seksi -->
            <div class="mb-3">
                <label for="nama_seksi" class="form-label">Nama Seksi</label>
                <input type="text" class="form-control" id="nama_seksi" name="nama_seksi" value="{{ old('nama_seksi') }}" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Simpan Seksi</button>
            <a href="{{ route('seksi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
