<?php

namespace App\Http\Controllers;

use App\Models\ItemKeranjang;
use App\Models\Keranjang;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $cart=Keranjang::firstOrCreate(
            ['user_id'=>auth()->id()]
        );
        $cart->load('item.produk');
        return view('customer.cart.index', compact('cart'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'kuantitas' => 'required|integer|min:1',
        ]);

        $item = ItemKeranjang::findOrFail($id);

        $item->kuantitas = $request->kuantitas;
        $item->subtotal = $item->kuantitas * $item->produk->price;

        $item->save();

        return back()->with('success', 'Kuantitas berhasil diperbarui!');
    }

    public function removeItem($id)
    {
        $item = ItemKeranjang::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Item Berhasil dihapus');
    }

    public function checkout(Request $request)
    {
        $cart = Keranjang::where('user_id', auth()->id())->first();

        if (! $cart || $cart->item->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong!');
        }
        $totalPrice = $cart->item->sum(function ($item) {
            return $item->kuantitas * $item->produk->price;
        });
        $orderNumber = 'ORD-'.strtoupper(Str::random(8));
        $defaultAddress = auth()->user()->defaultAddress;
        if (! $defaultAddress) {
            return back()->with('error', 'Anda belum memiliki alamat utama');
        }
        $request->validate([
            'payment_method' => 'required|in:cod,transfer',
        ]);
        $order = Orders::create([
            'user_id' => auth()->id(),
            'address_id' => $defaultAddress->id,
            'order_number' => $orderNumber,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);
        foreach ($cart->item as $item) {
            if ($item->produk->stock<$item->kuantitas) {
                return back()->with('error','Stok Produk'.$item->produk->name.'Tidak Cukup');
            }
            $item->produk->decrement('stock',$item->kuantitas);
            OrderItems::create([
                'order_id' => $order->id,
                'produk_id' => $item->id_produk,
                'kuantitas' => $item->kuantitas,
                'price' => $item->produk->price,
                'subtotal' => $item->kuantitas * $item->produk->price,
            ]);
        }
        $cart->item()->delete();

        return redirect()->route('order.success', $order->id)->with('success', 'Checkout berhasil!');
    }

    public function orderSuccess($id)
    {
        $order = Orders::with('itemOrder.product')->findOrFail($id);

        return view('customer.order_success', compact('order'));
    }
}
