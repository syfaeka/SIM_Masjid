<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\AuthController;

// HALAMAN PUBLIK (Bisa diakses siapa saja)
Route::get('/', [MasjidController::class, 'home']);

// HALAMAN LOGIN
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Nama 'login' wajib ada
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// GRUP HALAMAN KHUSUS ADMIN (DIPROTEKSI)
// Middleware 'auth' artinya: "Cek dulu, sudah login belum?"
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [MasjidController::class, 'index']);
    Route::post('/simpan-uang', [MasjidController::class, 'simpanUang'])->name('simpan.uang');
    Route::post('/simpan-barang', [MasjidController::class, 'simpanBarang'])->name('simpan.barang');
    // ... rute simpan sebelumnya ...
    
    // Rute Edit & Hapus
    Route::put('/transaksi/{id}/update', [MasjidController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}/hapus', [MasjidController::class, 'destroy'])->name('transaksi.destroy');
    // Rute Cetak PDF
    Route::get('/cetak-laporan', [MasjidController::class, 'cetakLaporan'])->name('cetak.laporan');
    // ... rute simpan uang & barang yang lama ...

    // Rute Kegiatan
    Route::post('/simpan-kegiatan', [MasjidController::class, 'simpanKegiatan'])->name('kegiatan.store');
    Route::delete('/kegiatan/{id}/hapus', [MasjidController::class, 'hapusKegiatan'])->name('kegiatan.destroy');
});