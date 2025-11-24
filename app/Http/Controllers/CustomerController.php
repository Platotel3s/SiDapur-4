<?php

namespace App\Http\Controllers;
use App\Models\Produk;
class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function tampilProduk()
    {
        $products = Produk::all();

        return view('customer.dashboard', compact('products'));
    }
}
