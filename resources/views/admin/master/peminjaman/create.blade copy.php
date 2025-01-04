@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Form Peminjaman</h1>
    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_peminjaman" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nama_peminjam">Nama Peminjam</label>
            <input type="text" name="nama_peminjam" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jabatan_peminjam">Jabatan Peminjam</label>
            <input type="text" name="jabatan_peminjam" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nik_peminjam">NIK Peminjam</label>
            <input type="text" name="nik_peminjam" class="form-control" required>
        </div>
        
        <!-- Dropdown for selecting items -->
        <div class="form-group">
            <label for="item_id">Nama Barang</label>
            <select name="item_id" id="item_id" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} -  {{ $item->code }}</option>
                @endforeach
            </select>
        </div>

        <!-- Hidden fields to store Merk, Model, and Nomor Seri -->
        <input type="hidden" name="merk" id="merk">
        <input type="hidden" name="model" id="model">
        <input type="hidden" name="nomor_seri" id="nomor_seri">

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="nama_penanggung_jawab">Nama Penanggung Jawab Aset</label>
            <input type="text" name="nama_penanggung_jawab" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jabatan_penanggung_jawab">Jabatan Penanggung Jawab Aset</label>
            <input type="text" name="jabatan_penanggung_jawab" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nik_penanggung_jawab">NIK Penanggung Jawab Aset</label>
            <input type="text" name="nik_penanggung_jawab" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="tanda_tangan_peminjam">Tanda Tangan Peminjam</label>
            <div class="text-right">
                <button type="button" class="btn btn-danger btn-sm" id="clear-peminjam">Clear</button>
            </div>
            <div class="wrapper_pad">
                <canvas id="signature-pad-peminjam" class="signature-pad"></canvas>
            </div>
            <input type="hidden" name="tanda_tangan_peminjam" id="tanda_tangan_peminjam">
        </div>

        <div class="form-group">
            <label for="tanda_tangan_penanggung_jawab">Tanda Tangan Penanggung Jawab Aset</label>
            <div class="text-right">
                <button type="button" class="btn btn-danger btn-sm" id="clear-penanggung-jawab">Clear</button>
            </div>
            <div class="wrapper_pad">
                <canvas id="signature-pad-penanggung-jawab" class="signature-pad"></canvas>
            </div>
            <input type="hidden" name="tanda_tangan_penanggung_jawab" id="tanda_tangan_penanggung_jawab">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection


