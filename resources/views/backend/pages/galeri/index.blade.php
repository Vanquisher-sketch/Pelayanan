@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Manajemen Galeri</h3>
            <a href="{{ route('galeri.create') }}" class="btn btn-primary">Tambah Foto</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                @forelse ($dataGaleri as $foto)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/galeri/' . $foto->path_foto) }}" class="card-img-top" alt="{{ $foto->judul_foto }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $foto->judul_foto }}</h5>
                                <form action="{{ route('galeri.destroy', $foto) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Belum ada foto di galeri.</p>
                    </div>
                @endforelse
            </div>
            {{ $dataGaleri->links() }}
        </div>
    </div>
</div>
@endsection