<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
        'order_id',
        'payment_proof',
        'provider',
        'paid_at',
        'amount',
    ];
    public function order(){
        return $this->belongsTo(Orders::class);
    }
}
