<?php

namespace App\Http\Controllers;

use App\Models\Products;

class CustomerProductController extends Controller
{
    public function index()
    {
        $products = Products::with('category')->get();

        return view('customer.products.index', compact('products'));
    }

    public function show($id)
    {
        $selectedProducts = Products::with('category')->findOrFail($id);

        return view('customer.products.show', compact('selectedProducts'));
    }
}
