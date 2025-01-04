@extends('layouts.app')

@section('scripts')
<script>
    $(document).ready(function() {
        // Function to initialize signature pads
        function initializeSignaturePads() {
            var canvasPeminjam = document.getElementById('signature-pad-peminjam');
            var signaturePadPeminjam = new SignaturePad(canvasPeminjam);
            var canvasPenanggungJawab = document.getElementById('signature-pad-penanggung-jawab');
            var signaturePadPenanggungJawab = new SignaturePad(canvasPenanggungJawab);

            // Set canvas size for better precision
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

            // On form submit, get the signature data
            $("form").submit(function() {
                if (signaturePadPeminjam.isEmpty()) {
                    alert("Tanda Tangan Peminjam Kosong! Silahkan tanda tangan terlebih dahulu.");
                    return false; // Prevent form submission
                }
                if (signaturePadPenanggungJawab.isEmpty()) {
                    alert("Tanda Tangan Penanggung Jawab Kosong! Silahkan tanda tangan terlebih dahulu.");
                    return false; // Prevent form submission
                }

                // Store the signature data in hidden fields
                var peminjamData = signaturePadPeminjam.toDataURL('image/png');
                var penanggungJawabData = signaturePadPenanggungJawab.toDataURL('image/png');

                $("#tanda_tangan_peminjam").val(peminjamData);
                $("#tanda_tangan_penanggung_jawab").val(penanggungJawabData);
            });
        }

        // Function to resize canvas
        function resizeCanvas(canvas) {
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        // Initialize signature pads
        initializeSignaturePads();

        // Resize canvas on window resize
        $(window).resize(function() {
            resizeCanvas(document.getElementById('signature-pad-peminjam'));
            resizeCanvas(document.getElementById('signature-pad-penanggung-jawab'));
        });

        // JavaScript to populate the merk, model, and nomor seri based on selected item
        document.getElementById('item_id').addEventListener('change', function() {
            const itemId = this.value;
            if (itemId) {
                fetch(`/items/${itemId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('merk').value = data.brand_id; // Assuming brand_id is the brand name
                        document.getElementById('model').value = data.model_barang;
                        document.getElementById('nomor_seri').value = data.serial_number;
                    });
            } else {
                document.getElementById('merk').value = '';
                document.getElementById('model').value = '';
                document.getElementById('nomor_seri').value = '';
            }
        });
    });
</script>
@endsection

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
                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->code }}</option>
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
            <label>Tanda Tangan</label>
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1 mr-2">
                    <label for="tanda_tangan_peminjam">Tanda Tangan Peminjam</label>
                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-sm" id="clear-peminjam">Clear</button>
                    </div>
                    <div class="wrapper_pad">
                        <canvas id="signature-pad-peminjam" class="signature-pad"></canvas>
                    </div>
                    <input type="hidden" name="tanda_tangan_peminjam" id="tanda_tangan_peminjam">
                </div>
                <div class="flex-grow-1 ml-2">
                    <label for="tanda_tangan_penanggung_jawab">Tanda Tangan Penanggung Jawab Aset</label>
                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-sm" id="clear-penanggung-jawab">Clear</button>
                    </div>
                    <div class="wrapper_pad">
                        <canvas id="signature-pad-penanggung-jawab" class="signature-pad"></canvas>
                    </div>
                    <input type="hidden" name="tanda_tangan_penanggung_jawab" id="tanda_tangan_penanggung_jawab">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
