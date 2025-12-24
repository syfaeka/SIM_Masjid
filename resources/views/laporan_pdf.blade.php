<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; color: #555; }
        hr { border: 1px solid #333; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-end { text-align: right; }
        .masuk { color: green; }
        .keluar { color: red; }
    </style>
</head>
<body>

    <div class="header">
        <h2>MASJID Agung Baitul Hakim</h2>
        <p>Jl. Aloon-Aloon Barat, Pangongangan, Kec. Manguharjo, Kota Madiun, Jawa Timur 63121</p>
        <p>Laporan Riwayat Keuangan Masjid</p>
    </div>

    <hr>

    <p>Tanggal Cetak: {{ date('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Jenis</th>
                <th class="text-end">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $totalMasuk = 0; $totalKeluar = 0; @endphp
            @foreach($riwayat as $index => $r)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d-m-Y', strtotime($r->tanggal)) }}</td>
                <td>{{ strtoupper($r->kategori) }}</td>
                <td>{{ $r->keterangan }}</td>
                <td>
                    @if($r->jenis == 'masuk')
                        @php $totalMasuk += $r->jumlah; @endphp
                        <span class="masuk">Masuk</span>
                    @else
                        @php $totalKeluar += $r->jumlah; @endphp
                        <span class="keluar">Keluar</span>
                    @endif
                </td>
                <td class="text-end">{{ number_format($r->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end"><strong>Total Pemasukan</strong></td>
                <td class="text-end"><strong>Rp {{ number_format($totalMasuk, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td colspan="5" class="text-end"><strong>Total Pengeluaran</strong></td>
                <td class="text-end"><strong>Rp {{ number_format($totalKeluar, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td colspan="5" class="text-end" style="background-color: #ddd;"><strong>SISA SALDO AKHIR</strong></td>
                <td class="text-end" style="background-color: #ddd;"><strong>Rp {{ number_format($totalMasuk - $totalKeluar, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>