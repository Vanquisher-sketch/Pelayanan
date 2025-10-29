@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Manajemen Pengumuman</h3>
            <a href="{{ route('pengumuman.create') }}" class="btn btn-primary">Tambah Pengumuman</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Tanggal Publikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataPengumuman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/pengumuman/' . $item->gambar) }}" alt="{{ $item->judul }}" width="100">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_publikasi)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('pengumuman.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('pengumuman.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data pengumuman masih kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $dataPengumuman->links() }}
        </div>
    </div>
</div>
@endsection