<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'unit',
        'thumbnail',
    ];

    public function gambar()
    {
        return $this->hasMany(GambarProduk::class);
    }

    public function itemProduct()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function custome()
    {
        return $this->hasMany(CustomOrders::class);
    }
}
