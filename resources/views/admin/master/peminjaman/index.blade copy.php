@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Peminjaman</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal Peminjaman</th>
                <th>Nama Peminjam</th>
                <th>Nama Barang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
            <tr>
                <td>{{ $item->tanggal_peminjaman }}</td>
                <td>{{ $item->nama_peminjam }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>
                    <a href="{{ route('peminjaman.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn btn-warning btn-sm">Update</a>
                    <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Hapus</button>
                    </form>
                    <a href="{{ route('peminjaman.signature', $item->id) }}" class="btn btn-primary btn-sm">Tanda Tangan</a> <!-- New button for signature -->
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
