<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        $categories = Kategori::all();

        return view('admin.products.index', compact(['products', 'categories']));
    }

    public function create(Request $request)
    {
        $categories = Kategori::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_barang' => 'required|string|max:255',
            'foto_barang' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'harga_barang' => 'required|numeric',
            'deskripsi_barang' => 'nullable|string',
        ]);
        $gambarProdukFolder = null;
        if ($request->hasFile('foto_barang')) {
            $ext = $request->file('foto_barang')->getClientOriginalExtension();
            $namingFile = now()->format('YmdHis').'.'.$ext;
            $gambarProdukFolder = $request->file('foto_barang')->storeAs('gambarProduk', $namingFile, 'public');
        }
        $products = Produk::create([
            'kategori_id' => $request->kategori_id,
            'nama_barang' => $request->nama_barang,
            'foto_barang' => $gambarProdukFolder,
            'harga_barang' => $request->harga_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Berhasil tambah');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
