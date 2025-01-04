<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Peminjaman extends Model
{
    //
    use HasFactory;
    protected $table = 'peminjaman'; // Explicitly define the table name

    protected $fillable = [
        'tanggal_peminjaman',
        'nama_peminjam',
        'jabatan_peminjam',
        'nik_peminjam',
        'nama_barang',
        'merk',
        'model',
        'nomor_seri',
        'keterangan',
        'nama_penanggung_jawab',
        'jabatan_penanggung_jawab',
        'nik_penanggung_jawab',
        'tanda_tangan_peminjam',
        'tanda_tangan_penanggung_jawab',
    ];
}
