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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->date('tanggal_peminjaman');
            $table->string('nama_peminjam');
            $table->string('jabatan_peminjam');
            $table->string('nik_peminjam');
            $table->string('nama_barang');
            $table->string('merk');
            $table->string('model');
            $table->string('nomor_seri');
            $table->text('keterangan')->nullable();
            $table->string('nama_penanggung_jawab');
            $table->string('jabatan_penanggung_jawab');
            $table->string('nik_penanggung_jawab');
            $table->string('tanda_tangan_peminjam')->nullable(); // Path to signature image
            $table->string('tanda_tangan_penanggung_jawab')->nullable(); // Path to signature image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
