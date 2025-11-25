<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemKeranjang extends Model
{
    protected $fillable = [
        'id_keranjang',
        'id_produk',
        'kuantitas',
        'subtotal',
    ];
}
