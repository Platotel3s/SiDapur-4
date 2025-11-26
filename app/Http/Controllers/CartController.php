<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Products;

class CartController extends Controller
{
    public function add(Products $products)
    {
        $cart = Keranjang::firstOrCreate([
            'user_id' => auth()->id(),
        ]);
        $item = $cart->item()->where('id_produk', $products->id)->first();
        if ($item) {
            $item->kuantitas += 1;
            $item->save();
        } else {
            $cart->item()->create([
                'id_produk' => $products->id,
                'kuantitas' => 1,
                'subtotal' => $products->price,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang');

    }

    public function index()
    {
        $cart = auth()->user()->cart()->with('item.produk')->first();

        return view('customer.cart.index', compact('cart'));
    }
}
