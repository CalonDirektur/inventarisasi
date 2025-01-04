@extends('layouts.app')

@section('content')
<div class="container">
    <h1>BERITA ACARA SERAH TERIMA (BAST) SARANA KERJA</h1>
    <hr>
    
    <h4>Informasi Hari</h4>
    <p>Pada hari tanggal <strong>{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d') }}</strong> bulan <strong>{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('F') }}</strong> tahun <strong>{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('Y') }}</strong>, kami yang bertanda tangan di bawah ini:</p>
    
    <h4>Informasi Pihak Pertama</h4>
    <p><strong>NAMA:</strong> {{ $peminjaman->nama_peminjam }}</p>
    <p><strong>JABATAN:</strong> {{ $peminjaman->jabatan_peminjam }}</p>
    <p><strong>NIK:</strong> {{ $peminjaman->nik_peminjam }}</p>
    <p>Dalam hal ini mewakili PIHAK PERTAMA</p>

    <h4>Informasi Pihak Kedua</h4>
    <p><strong>NAMA:</strong> {{ $peminjaman->nama_penanggung_jawab }}</p>
    <p><strong>JABATAN:</strong> {{ $peminjaman->jabatan_penanggung_jawab }}</p>
    <p><strong>NIK:</strong> {{ $peminjaman->nik_penanggung_jawab }}</p>
    <p>Dalam hal ini mewakili PIHAK KEDUA</p>

    <h4>Pernyataan</h4>
    <p>PIHAK PERTAMA dan PIHAK KEDUA dengan ini menyatakan sebagai berikut:</p>
    <p>PIHAK PERTAMA menerima dari PIHAK KEDUA 1 (satu) Unit <strong>{{ $peminjaman->nama_barang }}</strong> dengan rincian:</p>
    <p><strong>MERK:</strong> {{ $peminjaman->merk }}</p>
    <p><strong>TYPE:</strong> {{ $peminjaman->model }}</p>
    <p><strong>NO SERI:</strong> {{ $peminjaman->nomor_seri }}</p>
    <p><strong>KETERANGAN:</strong> {{ $peminjaman->keterangan }}</p>

    <h4>Pernyataan 2</h4>
    <p>PIHAK KEDUA menyerahkan 1 (satu) Unit <strong>{{ $peminjaman->nama_barang }}</strong> dengan rincian di atas KEPADA PIHAK PERTAMA untuk digunakan sebagaimana fungsinya. Dimana <strong>{{ $peminjaman->nama_barang }}</strong> tersebut merupakan Asset PT GSD, PIHAK PERTAMA berkewajiban untuk memelihara agar tetap dalam kondisi yang baik.</p>

    <p>Demikian Berita Acara Serah Terima Unit ini, dibuat dalam rangkap 2 (dua) untuk dipergunakan sebagaimana mestinya.</p>

    <h4>Tanda Tangan</h4>
    <div class="row">
        <div class="col-md-6">
            <p><strong>PIHAK PERTAMA:</strong></p>
            @if($peminjaman->tanda_tangan_peminjam)
                <img src="{{ $peminjaman->tanda_tangan_peminjam }}" alt="Tanda Tangan Peminjam" style="max-width: 200px; display: block; margin-bottom: 10px;">
            @else
                <p>Tanda tangan belum ada.</p>
            @endif
        </div>
        <div class="col-md-6">
            <p><strong>PIHAK KEDUA:</strong></p>
            @if($peminjaman->tanda_tangan_penanggung_jawab)
                <img src="{{ $peminjaman->tanda_tangan_penanggung_jawab }}" alt="Tanda Tangan Penanggung Jawab" style="max-width: 200px; display: block; margin-bottom: 10px;">
            @else
                <p>Tanda tangan belum ada.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
