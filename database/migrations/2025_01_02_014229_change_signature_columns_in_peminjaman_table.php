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
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->text('tanda_tangan_peminjam')->nullable()->change(); // Change to TEXT
            $table->text('tanda_tangan_penanggung_jawab')->nullable()->change(); // Change to TEXT
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Change back to TEXT instead of VARCHAR(255)
            $table->text('tanda_tangan_peminjam')->nullable()->change();
            $table->text('tanda_tangan_penanggung_jawab')->nullable()->change();
        });
    }
};
