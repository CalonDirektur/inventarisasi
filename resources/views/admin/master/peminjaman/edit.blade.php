@extends('layouts.app')

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize signature pads
    var canvasPeminjam = document.getElementById('signature-pad-peminjam');
    var signaturePadPeminjam = new SignaturePad(canvasPeminjam);
    var canvasPenanggungJawab = document.getElementById('signature-pad-penanggung-jawab');
    var signaturePadPenanggungJawab = new SignaturePad(canvasPenanggungJawab);

    // Function to resize canvas for better precision
    function resizeCanvas(canvas) {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    // Resize canvas on load
    resizeCanvas(canvasPeminjam);
    resizeCanvas(canvasPenanggungJawab);

    // Clear signature pad for Peminjam
    $("#clear-peminjam").click(function() {
        signaturePadPeminjam.clear();
    });

    // Clear signature pad for Penanggung Jawab
    $("#clear-penanggung-jawab").click(function() {
        signaturePadPenanggungJawab.clear();
    });

    $("form").submit(function() {
        // Check if signatures are required
        var existingPeminjamSignature = "{{ $peminjaman->tanda_tangan_peminjam ?? '' }}";
        var existingPenanggungJawabSignature = "{{ $peminjaman->tanda_tangan_penanggung_jawab ?? '' }}";

        if (existingPeminjamSignature && signaturePadPeminjam.isEmpty()) {
            alert("Anda harus menggambar ulang tanda tangan Peminjam sebelum menyimpan.");
            return false; // Prevent form submission
        }

        if (existingPenanggungJawabSignature && signaturePadPenanggungJawab.isEmpty()) {
            alert("Anda harus menggambar ulang tanda tangan Penanggung Jawab sebelum menyimpan.");
            return false; // Prevent form submission
        }

        // Store the signature data in hidden fields
        var peminjamData = signaturePadPeminjam.toDataURL('image/png');
        var penanggungJawabData = signaturePadPenanggungJawab.toDataURL('image/png');

        $("#tanda_tangan_peminjam").val(peminjamData);
        $("#tanda_tangan_penanggung_jawab").val(penanggungJawabData);
    });

    // Resize canvas on window resize
    $(window).resize(function() {
        resizeCanvas(canvasPeminjam);
        resizeCanvas(canvasPenanggungJawab);
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <h1>Edit Peminjaman</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
        
        <!-- Dropdown for selecting items -->
        <div class="form-group">
            <label for="item_id">Nama Barang</label>
            <select name="item_id" id="item_id" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}" {{ $item->code == $peminjaman->nama_barang ? 'selected' : '' }}>
                        {{ $item->name }} - {{ $item->code }}
                    </option>
                @endforeach
            </select>
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

        <!-- Display existing signature for Peminjam -->
        <div class="form-group">
            <label for="tanda_tangan_peminjam">Tanda Tangan Peminjam</label>
            <div class="d-flex">
                <div class="mr-3">
                    @if($peminjaman->tanda_tangan_peminjam)
                        <img src="{{ $peminjaman->tanda_tangan_peminjam }}" alt="Tanda Tangan Peminjam" style="max-width: 500px; display: block; margin-bottom: 10px;">
                    @else
                        <p>Tanda tangan belum ada.</p>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-sm" id="clear-peminjam">Clear</button>
                    </div>
                    <div class="wrapper_pad">
                        <canvas id="signature-pad-peminjam" class="signature-pad" style="border: 1px solid #ccc; width: 100%; height: 260px;"></canvas>
                    </div>
                    <input type="hidden" name="tanda_tangan_peminjam" id="tanda_tangan_peminjam" value="{{ $peminjaman->tanda_tangan_peminjam }}">
                </div>
            </div>
        </div>

        <!-- Display existing signature for Penanggung Jawab -->
        <div class="form-group">
            <label for="tanda_tangan_penanggung_jawab">Tanda Tangan Penanggung Jawab Aset</label>
            <div class="d-flex">
                <div class="mr-3">
                    @if($peminjaman->tanda_tangan_penanggung_jawab)
                        <img src="{{ $peminjaman->tanda_tangan_penanggung_jawab }}" alt="Tanda Tangan Penanggung Jawab" style="max-width: 500px; display: block; margin-bottom: 10px;">
                    @else
                        <p>Tanda tangan belum ada.</p>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-sm" id="clear-penanggung-jawab">Clear</button>
                    </div>
                    <div class="wrapper_pad">
                        <canvas id="signature-pad-penanggung-jawab" class="signature-pad" style="border: 1px solid #ccc; width: 100%; height: 260px;"></canvas>
                    </div>
                    <input type="hidden" name="tanda_tangan_penanggung_jawab" id="tanda_tangan_penanggung_jawab" value="{{ $peminjaman->tanda_tangan_penanggung_jawab }}">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
