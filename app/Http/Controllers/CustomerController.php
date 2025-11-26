<?php

namespace App\Http\Controllers;

use App\Models\Products;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function tampilProduk()
    {
        $products = Products::all();

        return view('customer.dashboard', compact('products'));
    }
}
