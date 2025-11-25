<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    protected $fillable = [,
        'user_id',
        'label',
        'namaPenerima',
        'nomorPenerima',
        'alamat',
        'kota',
        'provinsi',
        'kodePos',
        'alamatUtama',
    ];
}
