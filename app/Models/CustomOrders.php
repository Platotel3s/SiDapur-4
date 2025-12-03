<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomOrders extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'request_note',
        'namaPenerima',
        'nomorHp',
        'alamat',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
