@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Peminjaman</h1>
    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ $peminjaman->tanggal_peminjaman }}" required>
        </div>
        <div class="form-group">
            <label for="nama_peminjam">Nama Peminjam</label>
            <input type="text" name="nama_peminjam" class="form-control" value="{{ $peminjaman->nama_peminjam }}" required>
        </div>
        <div class="form-group">
            <label for="jabatan_peminjam">Jabatan Peminjam</label>
            <input type="text" name="jabatan_peminjam" class="form-control" value="{{ $peminjaman->jabatan_peminjam }}" required>
        </div>
        <div class="form-group">
            <label for="nik_peminjam">NIK Peminjam</label>
            <input type="text" name="nik_peminjam" class="form-control" value="{{ $peminjaman->nik_peminjam }}" required>
        </div>
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="{{ $peminjaman->nama_barang }}" required>
        </div>
        <div class="form-group">
            <label for="merk">Merk</label>
            <input type="text" name="merk" class="form-control" value="{{ $peminjaman->merk }}" required>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" value="{{ $peminjaman->model }}" required>
        </div>
        <div class="form-group">
            <label for="nomor_seri">Nomor Seri</label>
            <input type="text" name="nomor_seri" class="form-control" value="{{ $peminjaman->nomor_seri }}" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $peminjaman->keterangan }}</textarea>
        </div>
        <div class="form-group">
            <label for="nama_penanggung_jawab">Nama Penanggung Jawab Aset</label>
            <input type="text" name="nama_penanggung_jawab" class="form-control" value="{{ $peminjaman->nama_penanggung_jawab }}" required>
        </div>
        <div class="form-group">
            <label for="jabatan_penanggung_jawab">Jabatan Penanggung Jawab Aset</label>
            <input type="text" name="jabatan_penanggung_jawab" class="form-control" value="{{ $peminjaman->jabatan_penanggung_jawab }}" required>
        </div>
        <div class="form-group">
            <label for="nik_penanggung_jawab">NIK Penanggung Jawab Aset</label>
            <input type="text" name="nik_penanggung_jawab" class="form-control" value="{{ $peminjaman->nik_penanggung_jawab }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
