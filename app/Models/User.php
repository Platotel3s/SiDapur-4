<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function alamat()
    {
        return $this->hasMany(Addresses::class);
    }

    public function cart()
    {
        return $this->hasOne(Keranjang::class);
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function defaultAddress()
    {
        return $this->hasOne(Addresses::class)->where('alamatUtama', true);
    }

    public function customOrder()
    {
        return $this->hasMany(CustomOrders::class);
    }
}
