<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Website Pelayanan Digital Kecamatan Tawang" />
        <meta name="author" content="Kecamatan Tawang" />
        <title>Pelayanan Digital - Kecamatan Tawang</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/favicon.ico') }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />

        <style>
            .status-box {
                border-radius: 0.5rem;
                padding: 1rem;
                margin-top: 1rem;
                text-align: left;
            }
            .status-success {
                background-color: #d1e7dd;
                color: #0f5132;
                border: 1px solid #badbcc;
            }
            .status-error {
                background-color: #f8d7da;
                color: #842029;
                border: 1px solid #f5c2c7;
            }
            .status-info {
                background-color: #cff4fc;
                color: #055160;
                border: 1px solid #b6effb;
            }
            .status-info hr {
                border-top: 1px solid #05516050;
            }
            .status-info strong {
                display: block;
                font-size: 1.1rem;
                margin-bottom: 0.5rem;
            }
            .portfolio-box img {
                width: 100%;
                height: 300px; /* Menyamakan tinggi gambar */
                object-fit: cover; /* Memastikan gambar terpotong rapi, tidak gepeng */
            }
        </style>
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Kecamatan Tawang</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#page-top">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#alur-layanan">Alur Layanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pengumuman">Pengumuman</a></li>
                        <li class="nav-item"><a class="nav-link" href="#lacak-layanan">Lacak Berkas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#ajukan-layanan">Ajukan Layanan</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Selamat Datang di Pelayanan Digital Kecamatan Tawang</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Urus dokumen Anda secara online. Cepat, mudah, dan transparan. Tidak perlu lagi bolak-balik ke kantor kecamatan.</p>
                        <a class="btn btn-primary btn-xl" href="#alur-layanan">Lihat Alur Layanan</a>
                    </div>
                </div>
            </div>
        </header>
        
        <section class="page-section bg-primary" id="lacak-layanan">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Sudah Mengajukan Permohonan?</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">Masukkan nomor tiket yang Anda dapatkan saat pengajuan untuk melihat progres permohonan Anda secara real-time.</p>
                        
                        <form class="row g-3 justify-content-center" method="GET" action="{{ route('permohonan.lacak') }}">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" id="nomor_tiket" name="nomor_tiket" placeholder="Masukkan Nomor Tiket Anda (cth: TWG-2025-001)" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-light btn-xl">Lacak Berkas</button>
                            </div>
                        </form>

                        @if (session('status_lacak'))
                            @php $status = session('status_lacak'); @endphp
                            <div class="status-box status-info text-dark">
                                <strong>Status Permohonan: {{ $status->nomor_tiket }}</strong>
                                <hr>
                                <p class="mb-1"><strong>Pemohon:</strong> {{ $status->nama_pemohon }}</p>
                                <p class="mb-1"><strong>Jenis:</strong> {{ $status->layanan->nama_layanan }}</p>
                                <p class="mb-1"><strong>Status Saat Ini:</strong> 
                                    <span class="badge bg-warning text-dark">{{ ucwords(str_replace('_', ' ', $status->status)) }}</span>
                                </p>
                                @if ($status->status == 'butuh_revisi')
                                    <p class="mb-0 mt-2"><strong>Catatan Revisi:</strong><br>{{ $status->keterangan_revisi }}</p>
                                @endif
                            </div>
                        @endif
                        @if (session('status_error'))
                            <div class="status-box status-error">
                                {{ session('status_error') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>

        <section class="page-section" id="alur-layanan">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Alur Pelayanan Kami</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-file-earmark-text fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">1. Isi Formulir & Upload</h3>
                            <p class="text-muted mb-0">Pilih layanan, isi data diri, dan unggah dokumen persyaratan Anda secara online.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-arrow-repeat fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">2. Verifikasi & Proses</h3>
                            <p class="text-muted mb-0">Petugas kami akan memverifikasi berkas Anda. Jika lengkap, akan langsung diproses.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-bell fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">3. Dapat Notifikasi Selesai</h3>
                            <p class="text-muted mb-0">Anda akan mendapat notifikasi via WA/Email jika berkas sudah selesai dan siap diambil.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-person-check fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">4. Datang & Ambil</h3>
                            <p class="text-muted mb-0">Datang ke kantor kecamatan hanya untuk mengambil berkas yang sudah jadi. Tanpa antre!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div id="pengumuman">
            <div class="container-fluid p-0">
                <div class="row g-0">

                    {{-- Mulai looping data dari controller --}}
                    @forelse ($items as $item)
                        <div class="col-lg-4 col-sm-6">
                            
                            {{-- Logika untuk menentukan judul dan path gambar berdasarkan tipe item --}}
                            @php
                                if ($item->type == 'Pengumuman') {
                                    $imageUrl = $item->gambar ? asset('storage/pengumuman/' . $item->gambar) : 'https://via.placeholder.com/600x400.png?text=No+Image';
                                    $title = $item->judul;
                                } else {
                                    $imageUrl = asset('storage/galeri/' . $item->path_foto);
                                    $title = $item->judul_foto;
                                }
                            @endphp

                            <a class="portfolio-box" href="{{ $imageUrl }}" title="{{ $title }}">
                                <img class="img-fluid" src="{{ $imageUrl }}" alt="{{ $title }}" />
                                <div class="portfolio-box-caption">
                                    <div class="project-category text-white-50">{{ $item->type }}</div>
                                    <div class="project-name">{{ $title }}</div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5 bg-light">
                            <p class="text-muted fs-5">Belum ada pengumuman atau galeri yang dipublikasikan.</p>
                        </div>
                    @endforelse
                    {{-- Selesai looping --}}

                </div>
            </div>
        </div>

        <section class="page-section" id="ajukan-layanan">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Form Pengajuan Layanan</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Silakan isi formulir di bawah ini dengan data yang benar. Pastikan Nomor WhatsApp Anda aktif untuk menerima notifikasi status permohonan.</p>
                    </div>
                </div>

                <div class="row gx-4 gx-lg-5 justify-content-center mb-3">
                    <div class="col-lg-6">
                        @if (session('success'))
                            <div class="status-box status-success">
                                {{ session('success') }}
                                @if (session('nomor_tiket'))
                                    <hr>
                                    Silakan simpan Nomor Tiket Anda untuk pelacakan:
                                    <strong style="font-size: 1.2rem; display: block; margin-top: 0.5rem;">{{ session('nomor_tiket') }}</strong>
                                @endif
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="status-box status-error">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="status-box status-error">
                                <strong>Gagal mengirim formulir:</strong>
                                <ul class="mb-0 mt-2" style="padding-left: 1.2rem;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <form id="contactForm" method="POST" action="{{ route('permohonan.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <select class="form-select" id="layanan_id" name="layanan_id" required>
                                    <option value="" disabled selected>-- Pilih Jenis Layanan --</option>
                                    @foreach($layanans as $layanan)
                                        <option value="{{ $layanan->id }}" {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                            {{ $layanan->nama_layanan }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="layanan_id">Jenis Layanan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nama_pemohon" name="nama_pemohon" type="text" placeholder="Masukkan nama lengkap Anda..." value="{{ old('nama_pemohon') }}" required />
                                <label for="nama_pemohon">Nama Lengkap Pemohon</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nik_pemohon" name="nik_pemohon" type="text" placeholder="3206..." value="{{ old('nik_pemohon') }}" required />
                                <label for="nik_pemohon">Nomor Induk Kependudukan (NIK)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="wa_pemohon" name="wa_pemohon" type="tel" placeholder="0812..." value="{{ old('wa_pemohon') }}" required />
                                <label for="wa_pemohon">Nomor WhatsApp Aktif</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email_pemohon" name="email_pemohon" type="email" placeholder="nama@email.com" value="{{ old('email_pemohon') }}" />
                                <label for="email_pemohon">Alamat Email (Opsional)</label>
                            </div>
                            <div class="mb-3">
                                <label for="berkas" class="form-label">Upload Berkas Persyaratan</label>
                                <input class="form-control" id="berkas" name="berkas[]" type="file" multiple required>
                                <div class="form-text">Anda bisa memilih lebih dari satu file (KTP, KK, Pengantar RT/RW, dll). Tipe file: PDF, JPG, PNG. Max 2MB per file.</div>
                            </div>
                            <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit">Kirim Permohonan</button></div>
                        </form>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-4 text-center mb-5 mb-lg-0">
                        <i class="bi-phone fs-2 mb-3 text-muted"></i>
                        <div>Informasi Pelayanan: (022) 123-4567</div>
                    </div>
                </div>
            </div>
        </section>
        
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2025 - Kecamatan Tawang</div></div>
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="{{ asset('template/js/scripts.js') }}"></script>
    </body>
</html>