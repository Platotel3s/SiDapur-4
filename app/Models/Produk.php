<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Produk extends Model
{
    use HasFactory;
    protected $fillable=[
        'kategori_id',
        'nama_barang',
        'foto_barang',
        'harga_barang',
        'deskripsi_barang',
    ];
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
