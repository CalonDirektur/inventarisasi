<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Brand;
use Illuminate\Support\Facades\Log;


class ItemController extends Controller
{
    public function __construct()
    {
        // Middleware auth diterapkan hanya pada metode tertentu
        $this->middleware('auth')->except(['showByCode', 'index']); // Pastikan showByCode tidak dilindungi
    }

    public function index(): View
    {
        $jenisbarang = Category::all();
        $satuan = Unit::all();
        $merk = Brand::all();
        return view('admin.master.barang.index', compact('jenisbarang', 'satuan', 'merk'));
    }

    // public function show($id)
    // {
    //     $item = Item::with('category', 'unit', 'brand')->findOrFail($id);
    //     return view('admin.master.barang.detail', compact('item'));
    // }

    // public function showByCode($code)
    // {
    //     $item = Item::with('category', 'unit', 'brand')->where('code', $code)->firstOrFail();
    //     $formattedPrice = $this->formatIDR($item->price); // Format harga
    //     return view('admin.master.barang.detail_new', compact('item'));
    // }

    public function showByCode($code)
    {
        // Ambil item berdasarkan kode
        $item = Item::with('category', 'unit', 'brand')->where('code', $code)->firstOrFail();

        // Format harga menggunakan metode formatIDR
        $formattedPrice = $this->formatIDR($item->price); // Pastikan formatIDR didefinisikan di controller

        // Kirim item dan formattedPrice ke view
        return view('admin.master.barang.detail_new', compact('item', 'formattedPrice'));
    }

 

    public function formatIDR($angka) {
        return 'RP. ' . number_format($angka, 0, ',', '.');
    }
       



    public function list(Request $request): JsonResponse
    {
        $items = Item::with('category', 'unit', 'brand')->latest()->get();
        if ($request->ajax()) {
            return DataTables::of($items)
                ->addColumn('img', function ($data) {
                    if (empty($data->image)) {
                        return "<img src='" . asset('default.png') . "' style='width:100%;max-width:240px;aspect-ratio:1;object-fit:cover;padding:1px;border:1px solid #ddd'/>";
                    }
                    return "<img src='" . asset('storage/barang/' . $data->image) . "' style='width:100%;max-width:240px;aspect-ratio:1;object-fit:cover;padding:1px;border:1px solid #ddd'/>";
                })
                ->addColumn('category_name', function ($data) {
                    return $data->category->name;
                })
                ->addColumn('unit_name', function ($data) {
                    return $data->unit->name;
                })
                ->addColumn('brand_name', function ($data) {
                    return $data->brand->name;
                })
                // ->addColumn('tindakan', function ($data) {
                //     $button = "<button class='detail btn btn-info m-1' id='" . $data->id . "'><i class='fas fa-eye'></i></button>";
                //     $button .= "<button class='ubah btn btn-success m-1' id='" . $data->id . "'><i class='fas fa-pen m-1'></i></button>";
                //     $button .= "<button class='hapus btn btn-danger m-1' id='" . $data->id . "'><i class='fas fa-trash m-1'></i></button>";
                    
                //     return $button;
                // })
                ->addColumn('tindakan', function ($data) {
                    // Tombol detail lama
                    $button = "<button class='detail btn btn-info m-1' id='" . $data->id . "'><i class='fas fa-eye'></i></button>";
                    $button .= "<button class='ubah btn btn-success m-1' id='" . $data->id . "'><i class='fas fa-pen m-1'></i></button>";
                    $button .= "<button class='hapus btn btn-danger m-1' id='" . $data->id . "'><i class='fas fa-trash m-1'></i></button>";
                
                    // Tambahkan tombol detail baru
                    $button .= "<a href='" . route('barang.showByCode', ['code' => $data->code]) . "' class='view-detail btn btn-primary m-1' target='_blank'><i class='fas fa-eye'></i> </a>";
                
                    return $button;
                })
                
                

                
                // ->addColumn('tindakan', function ($data) {
                //     $button = "<button class='ubah btn btn-success m-1' id='" . $data->id . "'><i class='fas fa-pen m-1'></i>" . __("edit") . "</button>";
                //     $button .= "<button class='hapus btn btn-danger m-1' id='" . $data->id . "'><i class='fas fa-trash m-1'></i>" . __("delete") . "</button>";
                //     return $button;
                // })
                ->rawColumns(['img', 'tindakan'])
                ->make(true);
        }
    }

    // public function save(Request $request): JsonResponse
    // {
    //     $data = [
    //         'name' => $request->name,
    //         'code' => $request->code,
    //         'price' => $request->price,
    //         'category_id' => $request->category_id,
    //         'brand_id' => $request->brand_id,
    //         'unit_id' => $request->unit_id,
    //     ];
    //     if ($request->file('image') != null) {
    //         $image = $request->file('image');
    //         $image->storeAs('public/barang/', $image->hashName());
    //         $img = $image->hashName();
    //         $data['image'] = $img;
    //     }
    //     Item::create($data);
    //     return response()->json([
    //         "message" => __("saved successfully")
    //     ])->setStatusCode(200);
    // }
    public function save(Request $request): JsonResponse
    {

        
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:items,code|max:255',
            'serial_number' => 'nullable|string|max:255',
            'model_barang' => 'nullable|string|max:255',
            'lokasi_barang' => 'nullable|string|max:255',
            'pengguna_barang' => 'nullable|string|max:255',
            'kondisi_barang' => 'nullable|string|max:255',
            'estimasi_tahun' => 'nullable|integer',
            'price' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'unit_id' => 'required|integer|exists:units,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
        ]);

        // Prepare data for saving
        $data = $validatedData;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imagePath = $image->storeAs('public/barang/', $image->hashName());
                $data['image'] = $image->hashName(); // Store the image name in the data array
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                return response()->json(['message' => 'Image upload failed'], 500);
            }
        }

        // Attempt to create the item
        try {
            Item::create($data);
            return response()->json([
                "message" => __("saved successfully")
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            // Log the error with detailed information
            Log::error('Error saving item: ' . $e->getMessage(), [
                'request' => $request->all(),
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Error saving item'], 500);
        }
    }



    // public function detail(Request $request): JsonResponse
    // {
    //     $id = $request->id;
    //     $data = Item::with('category', 'unit', 'brand')->find($id);
    //     $data['category_name'] = $data->category->name;
    //     $data['unit_name'] = $data->unit->name;
    //     return response()->json(
    //         ["data" => $data]
    //     )->setStatusCode(200);
    // }

    public function detail(Request $request): JsonResponse
{
    $id = $request->id;
    $data = Item::with('category', 'unit', 'brand')->find($id);

    if (!$data) {
        return response()->json(['message' => 'Item not found'], 404);
    }

    // Add additional fields to the response
    $data['category_name'] = $data->category->name;
    $data['unit_name'] = $data->unit->name;

    // Include the image path
    $data['image'] = $data->image; // Assuming 'image' is the column name in your database

    return response()->json(
        ["data" => $data]
    )->setStatusCode(200);
}



    public function detailByCode(Request $request): JsonResponse
    {
        $code = $request->code;
        $data = Item::with('category', 'unit', 'brand')->where("code", $code)->first();
        $data['category_name'] = $data->category->name;
        $data['unit_name'] = $data->unit->name;
        return response()->json(
            ["data" => $data]
        )->setStatusCode(200);
    }

    // public function update(Request $request): JsonResponse
    // {
    //     $id = $request->id;
    //     $item = Item::find($id);
    //     $data = [
    //         'name' => $request->name,
    //         'code' => $request->code,
    //         'price' => $request->price,
    //         'quantity' => $request->quantity,
    //         'category_id' => $request->category_id,
    //         'brand_id' => $request->brand_id,
    //         'unit_id' => $request->unit_id
    //     ];
    //     if ($request->file('image') != null) {
    //         Storage::delete('public/barang/' . $item->image);
    //         $image = $request->file('image');
    //         $image->storeAs('public/barang/', $image->hashName());
    //         $img = $image->hashName();
    //         $data['image'] = $img;
    //     }
    //     $item->fill($data);
    //     $item->save();
    //     return response()->json([
    //         "message" => __("data changed successfully")
    //     ])->setStatusCode(200);
    // }
    
    public function update(Request $request): JsonResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:items,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'model_barang' => 'nullable|string|max:255',
            'lokasi_barang' => 'nullable|string|max:255',
            'pengguna_barang' => 'nullable|string|max:255',
            'kondisi_barang' => 'nullable|string|max:255',
            'estimasi_tahun' => 'nullable|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'unit_id' => 'required|integer|exists:units,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
        ]);

        $id = $validatedData['id'];
        $item = Item::find($id);

        // Prepare data for updating
        $data = [
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'serial_number' => $validatedData['serial_number'],
            'model_barang' => $validatedData['model_barang'],
            'lokasi_barang' => $validatedData['lokasi_barang'],
            'pengguna_barang' => $validatedData['pengguna_barang'],
            'kondisi_barang' => $validatedData['kondisi_barang'],
            'estimasi_tahun' => $validatedData['estimasi_tahun'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
            'unit_id' => $validatedData['unit_id'],
        ];

        // Handle image upload if present
        if ($request->file('image') != null) {
            // Delete the old image if it exists
            if ($item->image) {
                Storage::delete('public/barang/' . $item->image);
            }
            // Store the new image
            $image = $request->file('image');
            $image->storeAs('public/barang/', $image->hashName());
            $data['image'] = $image->hashName(); // Update the image name in the data array
        }

        // Update the item with the new data
        $item->fill($data);
        $item->save();

        return response()->json([
            "message" => __("data changed successfully")
        ])->setStatusCode(200);
    }


    public function delete(Request $request): JsonResponse
    {
        $id = $request->id;
        $item = Item::find($id);
        Storage::delete('public/barang/' . $item->image);
        $status = $item->delete();
        if (!$status) {
            return response()->json(
                ["message" => __("data failed to delete")]
            )->setStatusCode(400);
        }
        return response()->json([
            "message" => __("data deleted successfully")
        ])->setStatusCode(200);
    }
}
