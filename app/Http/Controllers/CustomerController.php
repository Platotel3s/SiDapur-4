<?php

namespace App\Http\Controllers;

use App\Models\Products;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $products = Products::all();

        return view('customer.dashboard',compact('products'));
    }

    public function tampilProduk()
    {
        $products = Products::all();

        return view('customer.dashboard', compact('products'));
    }
}
