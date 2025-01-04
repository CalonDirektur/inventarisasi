<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman; // Ensure this line is present
use Illuminate\Http\Request;
use App\Models\Item; // Adjust the namespace if your model is in a different directory



class PeminjamanController extends Controller
{
    //
    // public function create()
    // {
    //     return view('admin.master.peminjaman.create');
    // }

    public function create()
    {
        $items = Item::all(); // Assuming you have an Item model
        return view('admin.master.peminjaman.create', compact('items'));
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'tanggal_peminjaman' => 'required|date',
    //         'nama_peminjam' => 'required|string|max:255',
    //         'jabatan_peminjam' => 'required|string|max:255',
    //         'nik_peminjam' => 'required|string|max:20',
    //         'nama_barang' => 'required|string|max:255',
    //         'merk' => 'required|string|max:255',
    //         'model' => 'required|string|max:255',
    //         'nomor_seri' => 'required|string|max:255',
    //         'keterangan' => 'nullable|string',
    //         'nama_penanggung_jawab' => 'required|string|max:255',
    //         'jabatan_penanggung_jawab' => 'required|string|max:255',
    //         'nik_penanggung_jawab' => 'required|string|max:20',
    //         'tanda_tangan_peminjam' => 'nullable|string',
    //         'tanda_tangan_penanggung_jawab' => 'nullable|string',
    //     ]);

    //     Peminjaman::create($request->all());

    //     return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan.');
    // }

    // public function store(Request $request)
    // { //function untuk create. sudah berfungsi
    // $request->validate([
    //         'tanggal_peminjaman' => 'required|date',
    //         'nama_peminjam' => 'required|string|max:255',
    //         'jabatan_peminjam' => 'required|string|max:255',
    //         'nik_peminjam' => 'required|string|max:20',
    //         'item_id' => 'required|exists:items,id', // Validate that the item exists
    //         'keterangan' => 'nullable|string',
    //         'nama_penanggung_jawab' => 'required|string|max:255',
    //         'jabatan_penanggung_jawab' => 'required|string|max:255',
    //         'nik_penanggung_jawab' => 'required|string|max:20',
    //         'tanda_tangan_peminjam' => 'nullable|string',
    //         'tanda_tangan_penanggung_jawab' => 'nullable|string',
    //         'merk' => 'nullable|string', // Validate merk
    //         'model' => 'nullable|string', // Validate model
    //         'nomor_seri' => 'nullable|string', // Validate nomor seri
    //     ]);

    //     // Fetch the item to get the nama_barang
    //     $item = Item::findOrFail($request->item_id);

    //     // Create a new Peminjaman record
    //     Peminjaman::create([
    //         'tanggal_peminjaman' => $request->tanggal_peminjaman,
    //         'nama_peminjam' => $request->nama_peminjam,
    //         'jabatan_peminjam' => $request->jabatan_peminjam,
    //         'nik_peminjam' => $request->nik_peminjam,
    //         'item_id' => $request->item_id, // Save the selected item ID
    //         'nama_barang' => $item->name, // Save the nama_barang from the selected item
    //         'merk' => $item->brand_id, // Assuming brand_id is the merk
    //         'model' => $item->model_barang, // Save model from the item
    //         'nomor_seri' => $item->serial_number, // Save nomor seri from the item
    //         'keterangan' => $request->keterangan,
    //         'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
    //         'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
    //         'nik_penanggung_jawab' => $request->nik_penanggung_jawab,
    //         'tanda_tangan_peminjam' => $request->tanda_tangan_peminjam,
    //         'tanda_tangan_penanggung_jawab' => $request->tanda_tangan_penanggung_jawab,
    //     ]);

    //     return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_peminjaman' => 'required|date',
            'nama_peminjam' => 'required|string|max:255',
            'jabatan_peminjam' => 'required|string|max:255',
            'nik_peminjam' => 'required|string|max:20',
            'item_id' => 'required|exists:items,id', // Validate that the item exists
            'keterangan' => 'nullable|string',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'jabatan_penanggung_jawab' => 'required|string|max:255',
            'nik_penanggung_jawab' => 'required|string|max:20',
            'tanda_tangan_peminjam' => 'nullable|string',
            'tanda_tangan_penanggung_jawab' => 'nullable|string',
            'merk' => 'nullable|string', // Validate merk
            'model' => 'nullable|string', // Validate model
            'nomor_seri' => 'nullable|string', // Validate nomor seri
        ]);

        // Fetch the item to get the code
        $item = Item::findOrFail($request->item_id);

        // Create a new Peminjaman record
        Peminjaman::create([
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'nama_peminjam' => $request->nama_peminjam,
            'jabatan_peminjam' => $request->jabatan_peminjam,
            'nik_peminjam' => $request->nik_peminjam,
            'item_id' => $request->item_id, // Save the selected item ID
            'nama_barang' => $item->code, // Save the code from the selected item
            'merk' => $item->brand_id, // Assuming brand_id is the merk
            'model' => $item->model_barang, // Save model from the item
            'nomor_seri' => $item->serial_number, // Save nomor seri from the item
            'keterangan' => $request->keterangan,
            'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
            'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
            'nik_penanggung_jawab' => $request->nik_penanggung_jawab,
            'tanda_tangan_peminjam' => $request->tanda_tangan_peminjam,
            'tanda_tangan_penanggung_jawab' => $request->tanda_tangan_penanggung_jawab,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan.');
    }




    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('admin.master.peminjaman.index', compact('peminjaman'));
    }

    // public function show($id)
    // {
    //     $peminjaman = Peminjaman::findOrFail($id);
    //     return view('admin.master.peminjaman.detail', compact('peminjaman'));
    // }

    // public function show($id)
    // {
    //     $item = Item::findOrFail($id);
    //     return response()->json($item);
    // }
    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.master.peminjaman.detail', compact('peminjaman'));
    }



    // public function edit($id)
    // {
    //     $peminjaman = Peminjaman::findOrFail($id);
    //     return view('admin.master.peminjaman.edit', compact('peminjaman'));
    // }
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $items = Item::all(); // Fetch all items for the dropdown
        return view('admin.master.peminjaman.edit', compact('peminjaman', 'items'));
    }


    public function saveSignature(Request $request, $id)
    {
        $request->validate([
            'tanda_tangan_peminjam' => 'required|string',
            'tanda_tangan_penanggung_jawab' => 'required|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->tanda_tangan_peminjam = $request->tanda_tangan_peminjam;
        $peminjaman->tanda_tangan_penanggung_jawab = $request->tanda_tangan_penanggung_jawab;

        // Update the timestamp only if both signatures are provided
        if ($request->tanda_tangan_peminjam && $request->tanda_tangan_penanggung_jawab) {
            $peminjaman->tanda_tangan_waktu = now(); // Set current timestamp
        }

        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Tanda tangan berhasil disimpan.');
    }

    public function signature($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.master.peminjaman.signature', compact('peminjaman'));
    }


    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'tanggal_peminjaman' => 'required|date',
    //         'nama_peminjam' => 'required|string|max:255',
    //         'jabatan_peminjam' => 'required|string|max:255',
    //         'nik_peminjam' => 'required|string|max:20',
    //         'item_id' => 'required|exists:items,id', // Validate that the item exists
    //         'keterangan' => 'nullable|string',
    //         'nama_penanggung_jawab' => 'required|string|max:255',
    //         'jabatan_penanggung_jawab' => 'required|string|max:255',
    //         'nik_penanggung_jawab' => 'required|string|max:20',
    //         'tanda_tangan_peminjam' => 'nullable|string',
    //         'tanda_tangan_penanggung_jawab' => 'nullable|string',
    //     ]);

    //     // Find the existing Peminjaman record
    //     $peminjaman = Peminjaman::findOrFail($id);

    //     // Update the record
    //     $peminjaman->update([
    //         'tanggal_peminjaman' => $request->tanggal_peminjaman,
    //         'nama_peminjam' => $request->nama_peminjam,
    //         'jabatan_peminjam' => $request->jabatan_peminjam,
    //         'nik_peminjam' => $request->nik_peminjam,
    //         'item_id' => $request->item_id,
    //         'keterangan' => $request->keterangan,
    //         'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
    //         'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
    //         'nik_penanggung_jawab' => $request->nik_penanggung_jawab,
    //         'tanda_tangan_peminjam' => $request->tanda_tangan_peminjam,
    //         'tanda_tangan_penanggung_jawab' => $request->tanda_tangan_penanggung_jawab,
    //     ]);

    //     return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_peminjaman' => 'required|date',
            'nama_peminjam' => 'required|string|max:255',
            'jabatan_peminjam' => 'required|string|max:255',
            'nik_peminjam' => 'required|string|max:20',
            'item_id' => 'required|exists:items,id', // Validate that the item exists
            'keterangan' => 'nullable|string',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'jabatan_penanggung_jawab' => 'required|string|max:255',
            'nik_penanggung_jawab' => 'required|string|max:20',
            'tanda_tangan_peminjam' => 'nullable|string',
            'tanda_tangan_penanggung_jawab' => 'nullable|string',
        ]);

        // Find the existing Peminjaman record
        $peminjaman = Peminjaman::findOrFail($id);

        // Update the record
        $peminjaman->update([
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'nama_peminjam' => $request->nama_peminjam,
            'jabatan_peminjam' => $request->jabatan_peminjam,
            'nik_peminjam' => $request->nik_peminjam,
            'item_id' => $request->item_id,
            'keterangan' => $request->keterangan,
            'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
            'jabatan_penanggung_jawab' => $request->jabatan_penanggung_jawab,
            'nik_penanggung_jawab' => $request->nik_penanggung_jawab,
            'tanda_tangan_peminjam' => $request->tanda_tangan_peminjam,
            'tanda_tangan_penanggung_jawab' => $request->tanda_tangan_penanggung_jawab,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }




    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'tanggal_peminjaman' => 'required|date',
    //         'nama_peminjam' => 'required|string|max:255',
    //         'jabatan_peminjam' => 'required|string|max:255',
    //         'nik_peminjam' => 'required|string|max:20',
    //         'nama_barang' => 'required|string|max:255',
    //         'merk' => 'required|string|max:255',
    //         'model' => 'required|string|max:255',
    //         'nomor_seri' => 'required|string|max:255',
    //         'keterangan' => 'nullable|string',
    //         'nama_penanggung_jawab' => 'required|string|max:255',
    //         'jabatan_penanggung_jawab' => 'required|string|max:255',
    //         'nik_penanggung_jawab' => 'required|string|max:20',
    //         'tanda_tangan_peminjam' => 'nullable|string',
    //         'tanda_tangan_penanggung_jawab' => 'nullable|string',
    //     ]);

    //     $peminjaman = Peminjaman::findOrFail($id);
    //     $peminjaman->update($request->all());

    //     return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    // }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
