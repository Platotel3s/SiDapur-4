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
}
