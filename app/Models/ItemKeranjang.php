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
    public function keranjang(){
        return $this->belongsTo(Keranjang::class);
    }
    public function produk() {
        return $this->belongsTo(Products::class,'id_produk');
    }
}
