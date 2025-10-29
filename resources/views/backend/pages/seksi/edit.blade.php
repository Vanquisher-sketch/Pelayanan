@extends('backend.layouts.app')

{{-- Mengirimkan judul halaman ke layout --}}
@section('title', 'Edit Seksi')

{{-- Konten utama halaman --}}
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit Seksi</h1>

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
        <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Seksi</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('seksi.update', $seksi->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Nama Seksi -->
            <div class="mb-3">
                <label for="nama_seksi" class="form-label">Nama Seksi</label>
                <input type="text" class="form-control" id="nama_seksi" name="nama_seksi" value="{{ old('nama_seksi', $seksi->nama_seksi) }}" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $seksi->deskripsi) }}</textarea>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Update Seksi</button>
            <a href="{{ route('seksi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
