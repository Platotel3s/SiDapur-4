<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'order_number',
        'total_price',
        'status',
        'payment_method',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alamat()
    {
        return $this->belongsTo(Addresses::class);
    }

    public function itemOrder()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function payment()
    {
        return $this->hasOne(Payments::class);
    }
}
