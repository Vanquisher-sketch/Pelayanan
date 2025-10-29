@extends('backend.layouts.app')

{{-- Mengirimkan judul halaman ke layout --}}
@section('title', 'Edit Layanan')

{{-- Konten utama halaman --}}
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Layanan</h1>
    <a href="{{ route('layanan.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

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

<div class="card shadow-sm">
    <div class="card-body">
        <!-- Form di-arahkan ke route 'update' dengan method 'PUT' -->
        <form action="{{ route('layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Nama Layanan -->
            <div class="mb-3">
                <label for="nama_layanan" class="form-label">Nama Layanan</label>
                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
            </div>

            <!-- Seksi Penanggung Jawab -->
            <div class="mb-3">
                <label for="seksi_id" class="form-label">Seksi Penanggung Jawab</label>
                <select class="form-select" id="seksi_id" name="seksi_id" required>
                    <option value="" disabled>-- Pilih Seksi --</option>
                    @foreach ($seksis as $seksi)
                        <option value="{{ $seksi->id }}" {{ old('seksi_id', $layanan->seksi_id) == $seksi->id ? 'selected' : '' }}>
                            {{ $seksi->nama_seksi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
            </div>

            <!-- Persyaratan Dinamis (Sudah terisi data lama) -->
            <div class="mb-3">
                <label class="form-label">Persyaratan (Opsional)</label>
                <div id="persyaratan-wrapper">
                    <!-- Loop data persyaratan yang sudah ada -->
                    @if(is_array($layanan->persyaratan))
                        @foreach($layanan->persyaratan as $syarat)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="persyaratan[]" placeholder="Contoh: Fotokopi KTP" value="{{ $syarat }}">
                                <button class="btn btn-outline-danger" type="button" onclick="hapusPersyaratan(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" class="btn btn-success btn-sm mt-2" id="tambah-persyaratan">
                    <i class="bi bi-plus-circle"></i> Tambah Persyaratan
                </button>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Update Layanan</button>
        </form>
    </div>
</div>
@endsection

{{-- Kirim script khusus halaman ini ke layout --}}
@push('scripts')
<!-- JS untuk field dinamis (Sama seperti halaman create) -->
<script>
    document.getElementById('tambah-persyaratan').addEventListener('click', function() {
        let wrapper = document.getElementById('persyaratan-wrapper');
        let newField = document.createElement('div');
        newField.classList.add('input-group', 'mb-2');
        newField.innerHTML = `
            <input type="text" class="form-control" name="persyaratan[]" placeholder="Contoh: Fotokopi KTP">
            <button class="btn btn-outline-danger" type="button" onclick="hapusPersyaratan(this)">
                <i class="bi bi-trash"></i>
            </button>
        `;
        wrapper.appendChild(newField);
    });

    function hapusPersyaratan(button) {
        button.closest('.input-group').remove();
    }
</script>
@endpush

