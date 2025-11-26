<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    protected $fillable = [
        'id_produk',
        'gambar',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
