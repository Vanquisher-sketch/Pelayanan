@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Foto Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="judul_foto">Judul Foto</label>
                    <input type="text" name="judul_foto" class="form-control @error('judul_foto') is-invalid @enderror" value="{{ old('judul_foto') }}">
                    @error('judul_foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="path_foto">File Foto</label>
                    <input type="file" name="path_foto" class="form-control @error('path_foto') is-invalid @enderror">
                    @error('path_foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi_foto">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi_foto" rows="3" class="form-control @error('deskripsi_foto') is-invalid @enderror">{{ old('deskripsi_foto') }}</textarea>
                    @error('deskripsi_foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection