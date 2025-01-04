<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    // protected $fillable = [
    //     'name','image','code',
    //     'price','quantity','category_id','brand_id',
    //     'unit_id',
    //     'active'
    // ];

    protected $fillable = [
        'name',
        'image',
        'code',
        'price',
        'quantity',
        'category_id',
        'brand_id',
        'unit_id',
        'active',
        'serial_number', // New field
        'model_barang', // New field
        'lokasi_barang', // New field
        'pengguna_barang', // New field
        'kondisi_barang', // New field
        'estimasi_tahun', // New field
    ];

    public function category(): BelongsTo
    {
        return $this -> belongsTo(Category::class);
    }


    public function goodsIns():HasMany
    {
        return $this -> hasMany(GoodsIn::class);
    }

    public function goodsOuts():HasMany
    {
        return $this -> hasMany(GoodsOut::class);
    }

    public function unit(): BelongsTo
    {
        return $this -> belongsTo(Unit::class);
    }

    public function brand(): BelongsTo
    {
        return $this -> belongsTo(Brand::class);
    }


}
