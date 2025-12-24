<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MasjidController extends Controller
{
    // =========================
    // HALAMAN DEPAN (PUBLIC)
    // =========================
    public function home()
    {
        $saldoUmum         = $this->hitungSaldo('umum');
        $saldoPembangunan  = $this->hitungSaldo('pembangunan');
        $saldoYatim        = $this->hitungSaldo('yatim');
        $saldoOperasional  = $this->hitungSaldo('operasional');

        $agenda = Kegiatan::where('waktu', '>=', now())
                    ->orderBy('waktu', 'asc')
                    ->get();

        return view('landing', compact(
            'saldoUmum',
            'saldoPembangunan',
            'saldoYatim',
            'saldoOperasional',
            'agenda'
        ));
    }

    // =========================
    // DASHBOARD ADMIN
    // =========================
    public function index()
    {
        // 1. HITUNG SALDO
        $saldoUmum         = $this->hitungSaldo('umum');
        $saldoPembangunan  = $this->hitungSaldo('pembangunan');
        $saldoYatim        = $this->hitungSaldo('yatim');
        $saldoOperasional  = $this->hitungSaldo('operasional');

        // 2. BATASI DATA RIWAYAT (ANTI TIMEOUT)
        $riwayat = Transaksi::orderBy('tanggal', 'desc')
                    ->limit(50)
                    ->get();

        $agenda = Kegiatan::orderBy('waktu', 'desc')->get();

        // 3. DATA GRAFIK (OPTIMIZED – 1 QUERY SAJA)
        $pemasukanPerBulan    = array_fill(1, 12, 0);
        $pengeluaranPerBulan  = array_fill(1, 12, 0);

        $dataBulanan = Transaksi::selectRaw('
                MONTH(tanggal) as bulan,
                jenis,
                SUM(jumlah) as total
            ')
            ->whereYear('tanggal', date('Y'))
            ->groupBy('bulan', 'jenis')
            ->get();

        foreach ($dataBulanan as $row) {
            if ($row->jenis === 'masuk') {
                $pemasukanPerBulan[$row->bulan] = $row->total;
            } else {
                $pengeluaranPerBulan[$row->bulan] = $row->total;
            }
        }

        return view('admin', compact(
            'saldoUmum',
            'saldoPembangunan',
            'saldoYatim',
            'saldoOperasional',
            'riwayat',
            'agenda',
            'pemasukanPerBulan',
            'pengeluaranPerBulan'
        ));
    }

    // =========================
    // SIMPAN KEGIATAN
    // =========================
    public function simpanKegiatan(Request $request)
    {
        Kegiatan::create($request->except('_token'));
        return redirect('/admin')->with('sukses', 'Agenda berhasil ditambahkan');
    }

    public function hapusKegiatan($id)
    {
        Kegiatan::findOrFail($id)->delete();
        return redirect('/admin')->with('sukses', 'Agenda berhasil dihapus');
    }

    // =========================
    // SIMPAN TRANSAKSI
    // =========================
    public function simpanUang(Request $request)
    {
        Transaksi::create($request->except('_token'));
        return redirect('/admin')->with('sukses', 'Data berhasil disimpan');
    }

    public function simpanBarang(Request $request)
    {
        Barang::create($request->except('_token'));
        return redirect('/admin')->with('sukses', 'Data barang disimpan');
    }

    // =========================
    // UPDATE & DELETE
    // =========================
    public function update(Request $request, $id)
    {
        Transaksi::findOrFail($id)
            ->update($request->except(['_token', '_method']));

        return redirect('/admin')->with('sukses', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Transaksi::findOrFail($id)->delete();
        return redirect('/admin')->with('sukses', 'Data berhasil dihapus');
    }

    // =========================
    // CETAK PDF
    // =========================
    public function cetakLaporan()
    {
        $riwayat = Transaksi::orderBy('tanggal', 'desc')->get();

        $pdf = Pdf::loadView('laporan_pdf', [
            'judul'   => 'Laporan Keuangan Masjid',
            'riwayat' => $riwayat
        ]);

        return $pdf->download('laporan-keuangan-masjid.pdf');
    }

    // =========================
    // HELPER HITUNG SALDO
    // =========================
    private function hitungSaldo($kategori)
    {
        $masuk = Transaksi::where('kategori', $kategori)
                    ->where('jenis', 'masuk')
                    ->sum('jumlah');

        $keluar = Transaksi::where('kategori', $kategori)
                    ->where('jenis', 'keluar')
                    ->sum('jumlah');

        return $masuk - $keluar;
    }
}