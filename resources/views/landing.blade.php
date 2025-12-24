<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Agung Baitul Hakim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html { scroll-behavior: smooth; scroll-padding-top: 70px; }        
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://www.kontraktorkubahmasjid.com/wp-content/uploads/2017/06/Masjid-Agung-Baitul-Hakim-Madiun.png');
            background-size: cover;
            background-position: center;
            height: 100vh; /* Full layar */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        .fitur-icon { font-size: 2.5rem; margin-bottom: 15px; }
        .card-transparansi { 
            border: none; 
            background: white; 
            border-radius: 15px; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s; 
        }
        .card-transparansi:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        
        .section-title {
            position: relative;
            margin-bottom: 3rem;
            display: inline-block;
            font-weight: bold;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 50%;
            height: 3px;
            background: #198754;
            margin: 10px auto 0;
            border-radius: 2px;
        }
    </style>
</head>
<body id="home">

   <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home"><i class="fas fa-mosque me-2"></i>Baitul Hakim</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profil">Profil Masjid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#laporan">Laporan Kas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#agenda">Agenda</a>
                    </li>
                    
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a href="{{ url('/admin') }}" class="btn btn-warning btn-sm fw-bold px-3 rounded-pill">
                            <i class="fas fa-user-lock me-1"></i> Login Pengurus
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Selamat Datang di Masjid Baitul Hakim</h1>
            <p class="lead mb-4">"Hanya yang memakmurkan masjid-masjid Allah ialah orang-orang yang beriman kepada Allah dan Hari kemudian."</p>
            <a href="#laporan" class="btn btn-success btn-lg px-5 rounded-pill shadow">Lihat Laporan Infaq <i class="fas fa-arrow-down ms-2"></i></a>
        </div>
    </section>

   <div class="bg-dark text-white py-4 shadow">
        <div class="container">
            <div class="row text-center g-3">
                <div class="col-12 mb-2">
                    <h5 class="text-warning mb-0"><i class="fas fa-map-marker-alt me-2"></i>Jadwal Sholat Madiun & Sekitarnya</h5>
                    <small id="tanggal-hari-ini" class="text-secondary"></small>
                </div>
                <div class="col-4 col-md">
                    <small class="text-secondary text-uppercase fw-bold">Subuh</small>
                    <h4 class="fw-bold mb-0" id="waktu-subuh">--:--</h4>
                </div>
                <div class="col-4 col-md">
                    <small class="text-secondary text-uppercase fw-bold">Dzuhur</small>
                    <h4 class="fw-bold mb-0" id="waktu-dzuhur">--:--</h4>
                </div>
                <div class="col-4 col-md">
                    <small class="text-secondary text-uppercase fw-bold">Ashar</small>
                    <h4 class="fw-bold mb-0" id="waktu-ashar">--:--</h4>
                </div>
                <div class="col-4 col-md">
                    <small class="text-secondary text-uppercase fw-bold">Maghrib</small>
                    <h4 class="fw-bold mb-0" id="waktu-maghrib">--:--</h4>
                </div>
                <div class="col-4 col-md">
                    <small class="text-secondary text-uppercase fw-bold">Isya</small>
                    <h4 class="fw-bold mb-0" id="waktu-isya">--:--</h4>
                </div>
            </div>
        </div>
    </div>
    <section id="agenda" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Agenda Kegiatan Masjid</h2>
                <p class="text-muted">Mari ramaikan taman-taman surga di masjid kita tercinta.</p>
            </div>

            <div class="row g-4">
                @forelse($agenda as $a)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success text-white rounded p-2 text-center" style="min-width: 60px;">
                                    <div class="fw-bold" style="font-size: 1.2rem;">{{ date('d', strtotime($a->waktu)) }}</div>
                                    <div class="small">{{ date('M', strtotime($a->waktu)) }}</div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title fw-bold mb-0 text-success">{{ $a->nama_kegiatan }}</h5>
                                    <small class="text-muted"><i class="far fa-clock me-1"></i> {{ date('H:i', strtotime($a->waktu)) }} WIB</small>
                                </div>
                            </div>
                            <p class="card-text text-secondary border-top pt-3">
                                <i class="fas fa-user-tie me-2 text-warning"></i> Bersama: <strong>{{ $a->penceramah }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <div class="alert alert-info">Belum ada agenda kegiatan terdekat.</div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <section id="profil" class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center">
                <h2 class="section-title">Profil Masjid</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://image3.slideserve.com/5608168/profil-masjid-agung-baitul-hakim-kota-madiun-l.jpg" alt="Masjid" class="img-fluid rounded-4 shadow">
                </div>
                <div class="col-md-6">
                    <h4 class="fw-bold mb-3">Sejarah & Visi</h4>
                    <p class="text-secondary">
                        Merupakan masjid yang dibangun ketika terjadinya pergeseran pemerintahan kala itu.
                        Pasalnya masjid tersebut didirikan pada masa pemerintahan Belanda yang dipimpin Roro Jumeno pada tahun 1830. Menjadikannya salah satu masjid yang telah lama berdiri.
                        Pemugaran yang dilakukan pada masjid juga dilakukan pertama kali secara besar besaran di tahun 2002. Hal tersebut ditandai dengan adanya pemasangan tiang seribu. 
                        Sampai kini tiang tersebut pun masih dipertahankan sebagai salah satu ciri khas dari masjid.
                        Kemudian pada tahun 2011, perbaikan dan renovasi pun kembali dilakukan dengan melakukan perluasan pada bangunan. Terlebih lagi pada bagian serambi masjid dan kubah masjid. 
                        Tidak lupa juga pembaharuan menara yang hingga saat ini masih ada dan dapat ditemui pada bangunan masjid.

                    </p>
                    <div class="mt-4">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <span class="badge bg-success rounded-circle p-3"><i class="fas fa-bullseye"></i></span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-1">Visi Kami</h6>
                                <small class="text-muted">Mewujudkan masyarakat yang beriman, bertaqwa, dan berakhlak mulia.</small>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <span class="badge bg-success rounded-circle p-3"><i class="fas fa-hands-helping"></i></span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-1">Misi Kami</h6>
                                <small class="text-muted">Menyediakan layanan ibadah yang nyaman dan menyantuni kaum dhuafa.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="laporan" class="py-5">
        <div class="container py-4">
            <div class="text-center">
                <h2 class="section-title">Laporan Keuangan Terbuka</h2>
                <p class="text-muted mb-5">Transparansi dana umat yang dikelola secara amanah.</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="card card-transparansi h-100 p-4 text-center border-bottom border-success border-4">
                        <i class="fas fa-wallet fitur-icon text-success"></i>
                        <h6 class="text-uppercase text-secondary ls-1">Kas Umum</h6>
                        <h3 class="fw-bold text-dark mt-2">Rp {{ number_format($saldoUmum, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-transparansi h-100 p-4 text-center border-bottom border-primary border-4">
                        <i class="fas fa-hard-hat fitur-icon text-primary"></i>
                        <h6 class="text-uppercase text-secondary ls-1">Pembangunan</h6>
                        <h3 class="fw-bold text-dark mt-2">Rp {{ number_format($saldoPembangunan, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-transparansi h-100 p-4 text-center border-bottom border-info border-4">
                        <i class="fas fa-child fitur-icon text-info"></i>
                        <h6 class="text-uppercase text-secondary ls-1">Dana Yatim</h6>
                        <h3 class="fw-bold text-dark mt-2">Rp {{ number_format($saldoYatim, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-transparansi h-100 p-4 text-center border-bottom border-warning border-4">
                        <i class="fas fa-bolt fitur-icon text-warning"></i>
                        <h6 class="text-uppercase text-secondary ls-1">Operasional</h6>
                        <h3 class="fw-bold text-dark mt-2">Rp {{ number_format($saldoOperasional, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-mosque me-2"></i>Baitul Hakim</h5>
                    <p class="small text-secondary">Masjid adalah tempat suci bagi umat Islam untuk beribadah dan mendekatkan diri kepada Allah SWT.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Kontak Kami</h5>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jl. Aloon-Aloon Barat, Pangongangan, Kec. Manguharjo, Kota Madiun, Jawa Timur 63121</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> +62 812 3456 7890</li>
                        <li><i class="fas fa-envelope me-2"></i> info@BaitulHakim.com</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Jadwal Kajian</h5>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2">Senin (Maghrib) - Tafsir Quran</li>
                        <li class="mb-2">Kamis (Maghrib) - Yasinan Rutin</li>
                        <li>Minggu (Subuh) - Kajian Hadits</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center small text-secondary">
                &copy; {{ date('Y') }} Sistem Informasi Masjid Al-Ikhlas. Dibuat dengan Laravel.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.getElementById('navbarNav');
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {toggle: false});
                bsCollapse.hide();
            });
        });
    </script>
    <script>
        
        // Fungsi mendapatkan tanggal hari ini (Format: DD-MM-YYYY)
        function getTodayDate() {
            const d = new Date();
            const day = String(d.getDate()).padStart(2, '0');
            const month = String(d.getMonth() + 1).padStart(2, '0'); // Januari itu 0
            const year = d.getFullYear();
            return `${day}-${month}-${year}`;
        }

        // Tampilkan tanggal di layar
        document.getElementById('tanggal-hari-ini').innerText = getTodayDate();

        // Ambil Data dari API Aladhan (Metode 20 = Kemenag RI)
        fetch('https://api.aladhan.com/v1/timingsByCity?city=Madiun&country=Indonesia&method=20')
            .then(response => response.json())
            .then(data => {
                const jadwal = data.data.timings;

                
                
                // Masukkan jam ke dalam kotak masing-masing
                document.getElementById('waktu-subuh').innerText = jadwal.Fajr;
                document.getElementById('waktu-dzuhur').innerText = jadwal.Dhuhr;
                document.getElementById('waktu-ashar').innerText = jadwal.Asr;
                document.getElementById('waktu-maghrib').innerText = jadwal.Maghrib;
                document.getElementById('waktu-isya').innerText = jadwal.Isha;
            })
            .catch(error => {
                console.error('Gagal mengambil jadwal sholat:', error);
                document.getElementById('tanggal-hari-ini').innerText = "Gagal memuat jadwal";
            });
    </script>
</body>
</html>