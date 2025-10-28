<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Website Pelayanan Digital Kecamatan Tawang" />
        <meta name="author" content="Kecamatan Tawang" />
        <title>Pelayanan Digital - Kecamatan Tawang</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/favicon.ico') }}" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
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
        <!-- Masthead-->
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
        
        <!-- Lacak Layanan (Bagian 'About' yang dimodifikasi) -->
        <section class="page-section bg-primary" id="lacak-layanan">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Sudah Mengajukan Permohonan?</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">Masukkan nomor tiket yang Anda dapatkan saat pengajuan untuk melihat progres permohonan Anda secara real-time.</p>
                        <!-- Form Lacak Tiket -->
                        <form class="row g-3 justify-content-center">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-lg" id="nomorTiket" placeholder="Masukkan Nomor Tiket Anda (cth: TWG-2025-001)">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-light btn-xl">Lacak Berkas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alur Layanan (Bagian 'Services') -->
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
        
        <!-- Pengumuman / Galeri (Bagian 'Portfolio') -->
        <div id="pengumuman">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <!-- Ini akan di-looping dari backend (Manajemen Pengumuman/Galeri) -->
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{ asset('template/assets/img/portfolio/fullsize/1.jpg') }}" title="Judul Pengumuman 1">
                            <img class="img-fluid" src="{{ asset('template/assets/img/portfolio/thumbnails/1.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Pengumuman</div>
                                <div class="project-name">Judul Pengumuman atau Kegiatan 1</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{ asset('template/assets/img/portfolio/fullsize/2.jpg') }}" title="Judul Pengumuman 2">
                            <img class="img-fluid" src="{{ asset('template/assets/img/portfolio/thumbnails/2.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Galeri</div>
                                <div class="project-name">Judul Pengumuman atau Kegiatan 2</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{ asset('template/assets/img/portfolio/fullsize/3.jpg') }}" title="Judul Pengumuman 3">
                            <img class="img-fluid" src="{{ asset('template/assets/img/portfolio/thumbnails/3.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Galeri</div>
                                <div class="project-name">Judul Pengumuman atau Kegiatan 3</div>
                            </div>
                        </a>
                    </div>
                    <!-- Item 4, 5, 6 di-looping dengan cara yang sama -->
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{ asset('template/assets/img/portfolio/fullsize/4.jpg') }}" title="Judul Pengumuman 4">
                            <img class="img-fluid" src="{{ asset('template/assets/img/portfolio/thumbnails/4.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Pengumuman</div>
                                <div class="project-name">Judul Pengumuman atau Kegiatan 4</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{ asset('template/assets/img/portfolio/fullsize/5.jpg') }}" title="Judul Pengumuman 5">
                            <img class="img-fluid" src="{{ asset('template/assets/img/portfolio/thumbnails/5.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Pengumuman</div>
                                <div class="project-name">Judul Pengumuman atau Kegiatan 5</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{ asset('template/assets/img/portfolio/fullsize/6.jpg') }}" title="Judul Pengumuman 6">
                            <img class="img-fluid" src="{{ asset('template/assets/img/portfolio/thumbnails/6.jpg') }}" alt="..." />
                            <div class="portfolio-box-caption p-3">
                                <div class="project-category text-white-50">Galeri</div>
                                <div class="project-name">Judul Pengumuman atau Kegiatan 6</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Pengajuan Layanan (Bagian 'Contact') -->
        <section class="page-section" id="ajukan-layanan">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Form Pengajuan Layanan</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Silakan isi formulir di bawah ini dengan data yang benar. Pastikan Nomor WhatsApp Anda aktif untuk menerima notifikasi status permohonan.</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <!-- Ini adalah form utama Anda yang akan dihubungkan ke Controller -->
                        <form id="contactForm" method="POST" action="#">
                            @csrf
                            <!-- Pilihan Layanan (Dropdown) -->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="layanan_id" name="layanan_id" required>
                                    <option value="" disabled selected>-- Pilih Jenis Layanan --</option>
                                    <option value="1">Izin Keramaian</option>
                                    <option value="2">Pengantar SKTM</option>
                                    <option value="3">Rekomendasi IMB</option>
                                    <option value="4">Layanan Lainnya</option>
                                </select>
                                <label for="layanan_id">Jenis Layanan</label>
                            </div>

                            <!-- Nama Lengkap input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nama_pemohon" name="nama_pemohon" type="text" placeholder="Masukkan nama lengkap Anda..." required />
                                <label for="nama_pemohon">Nama Lengkap Pemohon</label>
                            </div>

                            <!-- NIK input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nik_pemohon" name="nik_pemohon" type="text" placeholder="3206..." required />
                                <label for="nik_pemohon">Nomor Induk Kependudukan (NIK)</label>
                            </div>

                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="wa_pemohon" name="wa_pemohon" type="tel" placeholder="0812..." required />
                                <label for="wa_pemohon">Nomor WhatsApp Aktif</label>
                            </div>
                            
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email_pemohon" name="email_pemohon" type="email" placeholder="nama@email.com" />
                                <label for="email_pemohon">Alamat Email (Opsional)</label>
                            </div>

                            <!-- Upload Berkas input-->
                            <div class="mb-3">
                                <label for="berkas" class="form-label">Upload Berkas Persyaratan</label>
                                <input class="form-control" id="berkas" name="berkas[]" type="file" multiple required>
                                <div class="form-text">Anda bisa memilih lebih dari satu file (KTP, KK, Pengantar RT/RW, dll).</div>
                            </div>
                            
                            <!-- Submit Button-->
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
        
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2025 - Kecamatan Tawang</div></div>
        </footer>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('template/js/scripts.js') }}"></script>
    </body>
</html>
