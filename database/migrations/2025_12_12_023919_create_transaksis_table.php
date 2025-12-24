<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->enum('kategori', ['umum', 'pembangunan', 'yatim', 'operasional']); // Pemisah Dana
        $table->string('keterangan');
        $table->enum('jenis', ['masuk', 'keluar']);
        $table->bigInteger('jumlah'); // Gunakan BigInteger untuk uang besar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
