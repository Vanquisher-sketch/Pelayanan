@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Banner</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('banner.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="judul_banner">Judul Banner</label>
                    <input type="text" name="judul_banner" class="form-control @error('judul_banner') is-invalid @enderror" value="{{ old('judul_banner', $banner->judul_banner) }}">
                    @error('judul_banner')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="link_banner">Link (Opsional)</label>
                    <input type="url" name="link_banner" class="form-control @error('link_banner') is-invalid @enderror" value="{{ old('link_banner', $banner->link_banner) }}" placeholder="https://contoh.com">
                    @error('link_banner')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="path_banner">File Banner (Kosongkan jika tidak diubah)</label>
                     @if($banner->path_banner)
                        <div class="my-2">
                            <img src="{{ asset('storage/banner/' . $banner->path_banner) }}" width="150">
                        </div>
                    @endif
                    <input type="file" name="path_banner" class="form-control @error('path_banner') is-invalid @enderror">
                    @error('path_banner')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status', $banner->status) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $banner->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('banner.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection