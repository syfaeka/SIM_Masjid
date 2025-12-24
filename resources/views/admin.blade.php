<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIM Masjid</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { overflow-x: hidden; background-color: #f4f6f9; font-family: sans-serif; }
        
        /* SIDEBAR */
        #sidebar-wrapper { min-height: 100vh; width: 260px; background: #1e293b; color: #fff; }
        .sidebar-heading { padding: 1.5rem; font-size: 1.3rem; font-weight: bold; border-bottom: 1px solid #334155; }
        .list-group-item { background: transparent; color: #cbd5e1; border: none; padding: 15px 25px; cursor: pointer; }
        .list-group-item:hover { background: #334155; color: #fff; }
        .list-group-item.active { background: #198754; color: white; border-radius: 0 25px 25px 0; font-weight: bold; }

        /* KARTU SALDO */
        .card-saldo { border: none; border-radius: 12px; color: white; transition: transform 0.3s; }
        .card-saldo:hover { transform: translateY(-5px); }
        .bg-gradient-success { background: linear-gradient(135deg, #11998e, #38ef7d); }
        .bg-gradient-blue { background: linear-gradient(135deg, #2193b0, #6dd5ed); }
        .bg-gradient-orange { background: linear-gradient(135deg, #fce38a, #f38181); }
        .bg-gradient-purple { background: linear-gradient(135deg, #834d9b, #d04ed6); }

        #page-content-wrapper { width: 100%; }
    </style>
</head>
<body>

<div class="d-flex" id="wrapper">

    <div id="sidebar-wrapper">
        <div class="sidebar-heading text-center"><i class="fas fa-mosque me-2"></i>SIM MASJID</div>
        <div class="list-group list-group-flush my-3">
            <button class="list-group-item list-group-item-action active" id="menu-dashboard" data-bs-toggle="pill" data-bs-target="#tab-dashboard">
                <i class="fas fa-home me-2"></i> Dashboard
            </button>
            <button class="list-group-item list-group-item-action" id="menu-keuangan" data-bs-toggle="pill" data-bs-target="#tab-keuangan">
                <i class="fas fa-wallet me-2"></i> Data Keuangan
            </button>
            <button class="list-group-item list-group-item-action" id="menu-agenda" data-bs-toggle="pill" data-bs-target="#tab-agenda">
                <i class="fas fa-calendar-alt me-2"></i> Agenda Kegiatan
            </button>
            <form action="{{ route('logout') }}" method="POST" class="mt-5 px-3">
                @csrf
                <button type="submit" class="btn btn-danger w-100 rounded-pill shadow-sm"><i class="fas fa-sign-out-alt me-2"></i> Keluar</button>
            </form>
        </div>
    </div>

    <div id="page-content-wrapper">
        <nav class="navbar navbar-light bg-white py-3 px-4 shadow-sm border-bottom">
            <h4 class="mb-0 fw-bold text-secondary" id="page-title">Ringkasan Masjid</h4>
            <div class="ms-auto d-flex align-items-center">
                <span class="text-muted small me-2">Halo, Pengurus</span>
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fas fa-user"></i></div>
            </div>
        </nav>

        <div class="container-fluid px-4 py-4">
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm">{{ session('sukses') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif

            <div class="tab-content">
                
                <div class="tab-pane fade show active" id="tab-dashboard">
                    <h5 class="text-secondary mb-3">Status Keuangan Terkini</h5>
                    <div class="row g-4">
                        <div class="col-md-3"><div class="card card-saldo bg-gradient-success h-100 p-4"><div><h6 class="text-white-50 small">KAS UMUM</h6><h3 class="fw-bold mb-0">Rp {{ number_format($saldoUmum ?? 0, 0, ',', '.') }}</h3></div><i class="fas fa-wallet fa-2x opacity-50"></i></div></div>
                        <div class="col-md-3"><div class="card card-saldo bg-gradient-blue h-100 p-4"><div><h6 class="text-white-50 small">PEMBANGUNAN</h6><h3 class="fw-bold mb-0">Rp {{ number_format($saldoPembangunan ?? 0, 0, ',', '.') }}</h3></div><i class="fas fa-hammer fa-2x opacity-50"></i></div></div>
                        <div class="col-md-3"><div class="card card-saldo bg-gradient-orange h-100 p-4 text-dark"><div><h6 class="text-dark-50 small">DANA YATIM</h6><h3 class="fw-bold mb-0">Rp {{ number_format($saldoYatim ?? 0, 0, ',', '.') }}</h3></div><i class="fas fa-hand-holding-heart fa-2x opacity-50"></i></div></div>
                        <div class="col-md-3"><div class="card card-saldo bg-gradient-purple h-100 p-4"><div><h6 class="text-white-50 small">OPERASIONAL</h6><h3 class="fw-bold mb-0">Rp {{ number_format($saldoOperasional ?? 0, 0, ',', '.') }}</h3></div><i class="fas fa-bolt fa-2x opacity-50"></i></div></div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <div class="card shadow border-0 rounded-4">
                                <div class="card-header bg-white py-3"><h6 class="mb-0 fw-bold"><i class="fas fa-chart-bar me-2"></i>Statistik Keuangan {{ date('Y') }}</h6></div>
                                <div class="card-body">
                                    <canvas id="grafikKeuangan" height="120"
                                        data-pemasukan="{{ json_encode($pemasukanPerBulan ?? []) }}"
                                        data-pengeluaran="{{ json_encode($pengeluaranPerBulan ?? []) }}">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow border-0 rounded-4 h-100 bg-success text-white">
                                <div class="card-body text-center p-4 d-flex flex-column justify-content-center">
                                    <i class="fas fa-chart-pie fa-4x mb-3 opacity-50"></i>
                                    <h4>Kesehatan Kas</h4>
                                    <p class="small opacity-75">Pantau terus perbandingan pemasukan dan pengeluaran agar operasional stabil.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-keuangan">
                    <div class="card shadow border-0 rounded-4">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold text-success"><i class="fas fa-money-bill-wave me-2"></i>Kelola Keuangan</h5>
                            <a href="{{ route('cetak.laporan') }}" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm" target="_blank"><i class="fas fa-file-pdf me-1"></i> Cetak PDF</a>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('simpan.uang') }}" method="POST" class="row g-3 mb-4 bg-light p-3 rounded-3 border-start border-success border-4">
                                @csrf
                                <div class="col-md-2"><label class="form-label small fw-bold">Tanggal</label><input type="date" name="tanggal" class="form-control" required></div>
                                <div class="col-md-2"><label class="form-label small fw-bold">Pos Dana</label><select name="kategori" class="form-select"><option value="umum">Kas Umum</option><option value="pembangunan">Pembangunan</option><option value="yatim">Yatim</option><option value="operasional">Operasional</option></select></div>
                                <div class="col-md-4"><label class="form-label small fw-bold">Keterangan</label><input type="text" name="keterangan" class="form-control" placeholder="Uraian..." required></div>
                                <div class="col-md-2"><label class="form-label small fw-bold">Jenis</label><select name="jenis" class="form-select"><option value="masuk">Pemasukan (+)</option><option value="keluar">Pengeluaran (-)</option></select></div>
                                <div class="col-md-2"><label class="form-label small fw-bold">Nominal</label><input type="number" name="jumlah" class="form-control" placeholder="0" required></div>
                                <div class="col-12 text-end"><button type="submit" class="btn btn-success px-4 rounded-pill"><i class="fas fa-save me-1"></i> Simpan</button></div>
                            </form>
                            <hr>
                            <h6 class="fw-bold mb-3"><i class="fas fa-history me-2"></i>Riwayat Transaksi</h6>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light"><tr><th>Tanggal</th><th>Kategori</th><th>Keterangan</th><th>Jenis</th><th class="text-end">Jumlah</th><th class="text-center">Aksi</th></tr></thead>
                                    <tbody>
                                        @foreach($riwayat as $r)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($r->tanggal)) }}</td>
                                            <td><span class="badge bg-secondary">{{ strtoupper($r->kategori) }}</span></td>
                                            <td>{{ $r->keterangan }}</td>
                                            <td>@if($r->jenis == 'masuk') <span class="text-success fw-bold">Masuk</span> @else <span class="text-danger fw-bold">Keluar</span> @endif</td>
                                            <td class="text-end fw-bold">Rp {{ number_format($r->jumlah, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-warning btn-sm me-1 rounded-circle" data-bs-toggle="modal" data-bs-target="#editModal{{ $r->id }}"><i class="fas fa-pencil-alt"></i></button>
                                                <form action="{{ route('transaksi.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm rounded-circle"><i class="fas fa-trash"></i></button></form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-agenda">
                    <div class="card shadow border-0 rounded-4">
                        <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold text-primary"><i class="fas fa-calendar-alt me-2"></i>Kelola Agenda</h5></div>
                        <div class="card-body p-4">
                            <form action="{{ route('kegiatan.store') }}" method="POST" class="row g-3 mb-4 bg-light p-3 rounded-3 border-start border-primary border-4">
                                @csrf
                                <div class="col-md-4"><label class="form-label small fw-bold">Kegiatan</label><input type="text" name="nama_kegiatan" class="form-control" placeholder="Cth: Khutbah" required></div>
                                <div class="col-md-3"><label class="form-label small fw-bold">Petugas</label><input type="text" name="penceramah" class="form-control" placeholder="Nama..." required></div>
                                <div class="col-md-3"><label class="form-label small fw-bold">Waktu</label><input type="datetime-local" name="waktu" class="form-control" required></div>
                                <div class="col-md-2 d-flex align-items-end"><button type="submit" class="btn btn-primary w-100 rounded-pill"><i class="fas fa-plus me-1"></i> Tambah</button></div>
                            </form>
                            <h6 class="fw-bold mb-3"><i class="fas fa-list me-2"></i>Daftar Agenda</h6>
                            <table class="table table-bordered table-hover">
                                <thead class="table-secondary"><tr><th>Waktu</th><th>Nama</th><th>Petugas</th><th class="text-center">Aksi</th></tr></thead>
                                <tbody>
                                    @foreach($agenda as $a)
                                    <tr>
                                        <td>{{ date('d M Y, H:i', strtotime($a->waktu)) }}</td>
                                        <td class="fw-bold text-primary">{{ $a->nama_kegiatan }}</td>
                                        <td>{{ $a->penceramah }}</td>
                                        <td class="text-center"><form action="{{ route('kegiatan.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm rounded-circle"><i class="fas fa-trash"></i></button></form></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($riwayat as $r)
<div class="modal fade" id="editModal{{ $r->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning"><h5 class="modal-title fw-bold">Edit Transaksi</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form action="{{ route('transaksi.update', $r->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3"><label>Tanggal</label> <input type="date" name="tanggal" class="form-control" value="{{ $r->tanggal }}" required></div>
                    <div class="mb-3"><label>Pos Dana</label><select name="kategori" class="form-select"><option value="umum" {{ $r->kategori == 'umum' ? 'selected' : '' }}>Kas Umum</option><option value="pembangunan" {{ $r->kategori == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option><option value="yatim" {{ $r->kategori == 'yatim' ? 'selected' : '' }}>Yatim</option><option value="operasional" {{ $r->kategori == 'operasional' ? 'selected' : '' }}>Operasional</option></select></div>
                    <div class="mb-3"><label>Keterangan</label> <input type="text" name="keterangan" class="form-control" value="{{ $r->keterangan }}" required></div>
                    <div class="mb-3"><label>Jenis</label><select name="jenis" class="form-select"><option value="masuk" {{ $r->jenis == 'masuk' ? 'selected' : '' }}>Pemasukan (+)</option><option value="keluar" {{ $r->jenis == 'keluar' ? 'selected' : '' }}>Pengeluaran (-)</option></select></div>
                    <div class="mb-3"><label>Jumlah</label> <input type="number" name="jumlah" class="form-control" value="{{ $r->jumlah }}" required></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // 1. Ganti Judul Halaman
    const titles = { 'menu-dashboard': 'Ringkasan Masjid', 'menu-keuangan': 'Kelola Data Keuangan', 'menu-agenda': 'Agenda Kegiatan Masjid' };
    document.querySelectorAll('.list-group-item').forEach(item => {
        item.addEventListener('click', event => {
            const id = event.currentTarget.id;
            if(titles[id]) document.getElementById('page-title').innerText = titles[id];
        });
    });

    // 2. Grafik (Mengambil data dari HTML Attribute, bukan PHP langsung)
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('grafikKeuangan');
        if (ctx) {
            // Ambil data dari attribute "data-pemasukan" di tag Canvas di atas
            const dataPemasukan = JSON.parse(ctx.dataset.pemasukan);
            const dataPengeluaran = JSON.parse(ctx.dataset.pengeluaran);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [
                        { label: 'Pemasukan', data: dataPemasukan, backgroundColor: '#198754', borderRadius: 4 },
                        { label: 'Pengeluaran', data: dataPengeluaran, backgroundColor: '#dc3545', borderRadius: 4 }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' }, tooltip: { callbacks: { label: function(c) { return 'Rp ' + c.raw.toLocaleString('id-ID'); } } } },
                    scales: { y: { beginAtZero: true, ticks: { callback: function(v) { return 'Rp ' + v.toLocaleString('id-ID'); } } } }
                }
            });
        }
    });
</script>

</body>
</html>