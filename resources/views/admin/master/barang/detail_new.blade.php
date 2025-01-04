@extends('layouts.app_no_sidebar')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            transition: background-color 300ms ease, color 300ms ease;
        }
        *:focus {
            background-color: rgba(221, 72, 20, .2);
            outline: none;
        }
        html, body {
            color: rgba(33, 37, 41, 1);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            font-size: 16px;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            background-color: #f8f9fa; /* Warna latar belakang */
        }
        header {
            background-color: rgba(247, 248, 249, 1);
            padding: .4rem 0;
            text-align: center; /* Rata tengah untuk logo */
        }
        .logo img {
            max-width: 200px; /* Ukuran maksimum logo */
            height: auto; /* Menjaga rasio aspek */
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 1.75rem;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .card-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #dd4814; /* Warna judul */
        }
        .img-fluid {
            max-width: 240px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        footer {
            background-color: rgba(221, 72, 20, .8);
            text-align: center;
            padding: 0.2rem 0;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="https://www.telkomproperty.co.id/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FlogoTelkomHeader.ff908c55.png&w=3840&q=75" alt="Logo Telkom Property">
    </div>
</header>

<div class="container">
    <div class="card">
        <h4 class="card-title">Informasi Barang</h4>
        <p><strong>Nama:</strong> {{ $item->name }}</p>
        <p><strong>Kode:</strong> {{ $item->code }}</p>
        <p><strong>Serial Number:</strong> {{ $item->serial_number }}</p>
        <p><strong>Model:</strong> {{ $item->model_barang }}</p>
        <p><strong>Lokasi:</strong> {{ $item->lokasi_barang }}</p>
        <p><strong>Pengguna:</strong> {{ $item->pengguna_barang }}</p>
        <p><strong>Kondisi:</strong> {{ $item->kondisi_barang }}</p>
        <p><strong>Estimasi Tahun Penggunaan:</strong> {{ $item->estimasi_tahun }}</p>
        <p><strong>Harga:</strong> {{ $formattedPrice }}</p>

        <h4 class="mt-4">Informasi Tambahan</h4>
        <p><strong>Jenis Barang:</strong> {{ $item->category->name }}</p>
        <p><strong>Satuan:</strong> {{ $item->unit->name }}</p>
        <p><strong>Merek:</strong> {{ $item->brand->name }}</p>

        <h4 class="mt-4">Foto Barang</h4>
        <div class="text-center">
            <img src="{{ $item->image ? asset('storage/barang/' . $item->image) : asset('default.png') }}" alt="Item Image" class="img-fluid">
        </div>
    </div>
</div>

<footer>
    <p>&copy; {{ date('Y') }} TelkomProperty Regional VII. All rights reserved.</p>
</footer>

</body>
</html>
@endsection
