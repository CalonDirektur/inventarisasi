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
        Schema::table('items', function (Blueprint $table) {
            //
            $table->string('serial_number')->nullable(); // Nomor Serial
            $table->string('model_barang')->nullable(); // Model Barang
            $table->string('lokasi_barang')->nullable(); // Lokasi Barang
            $table->string('pengguna_barang')->nullable(); // Pengguna Barang
            $table->string('kondisi_barang')->nullable(); // Kondisi Barang
            $table->year('estimasi_tahun')->nullable(); // Estimasi Tahun Penggunaan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            //
            $table->dropColumn('serial_number');
            $table->dropColumn('model_barang');
            $table->dropColumn('lokasi_barang');
            $table->dropColumn('pengguna_barang');
            $table->dropColumn('kondisi_barang');
            $table->dropColumn('estimasi_tahun');
        });
    }
};
