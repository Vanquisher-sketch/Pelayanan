@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Manajemen Banner</h3>
            <a href="{{ route('banner.create') }}" class="btn btn-primary">Tambah Banner</a>
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
                        <th>Banner</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataBanner as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/banner/' . $item->path_banner) }}" alt="{{ $item->judul_banner }}" width="150"></td>
                            <td>{{ $item->judul_banner }}</td>
                            <td><a href="{{ $item->link_banner }}" target="_blank">{{ $item->link_banner }}</a></td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('banner.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('banner.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data banner masih kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection