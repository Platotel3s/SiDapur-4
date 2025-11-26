<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(Keranjang::class,'user_id');
    }

    public function item()
    {
        return $this->hasMany(ItemKeranjang::class,'id_keranjang');
    }
}
