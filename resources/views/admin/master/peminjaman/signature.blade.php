@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tanda Tangan Peminjaman</h1>
    <form action="{{ route('peminjaman.signature.save', $peminjaman->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_peminjam">Nama Peminjam</label>
            <input type="text" class="form-control" value="{{ $peminjaman->nama_peminjam }}" readonly>
        </div>
        <div class="form-group">
            <label for="nama_penanggung_jawab">Nama Penanggung Jawab Aset</label>
            <input type="text" class="form-control" value="{{ $peminjaman->nama_penanggung_jawab }}" readonly>
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
