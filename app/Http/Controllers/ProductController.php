<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::paginate(5);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Categories::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable',
            'name' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable',
            'stock' => 'nullable',
            'unit' => 'nullable',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $pathImg = null;
        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->getClientOriginalExtension();
            $namingFile = now()->format('YmdHis').'.'.$ext;
            $pathImg = $request->file('thumbnail')->storeAs('gambarProduk', $namingFile, 'public');
        }
        Products::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'thumbnail' => $pathImg,
        ]);

        return redirect()->route('create.products')->with('success', 'Berhasil menambah produk');
    }

    public function edit(Request $request, $id)
    {
        $pilihProduk = Products::findOrFail($id);
        $categories = Categories::all();

        return view('admin.products.edit', compact('pilihProduk', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'nullable',
            'name' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable',
            'stock' => 'nullable',
            'unit' => 'nullable',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $pilihProduk = Products::findOrFail($id);
        $pathImg = $pilihProduk->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $ext = $request->file('thumbnail')->getClientOriginalExtension();
            $namingFile = now()->format('YmdHis').'.'.$ext;
            $pathImg = $request->file('thumbnail')->storeAs('gambarProduk', $namingFile, 'public');
        }
        $pilihProduk->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'unit' => $request->unit,
            'thumbnail' => $pathImg,
        ]);

        return redirect()->route('index.products')->with('success', 'Berhasil Update produk');
    }

    public function show(Request $request, string $id)
    {
        $pilihProduk = Products::findOrFail($id);
        $category = Categories::all();

        return view('admin.products.show', compact('pilihProduk', 'category'));
    }

    public function destroy(string $id)
    {
        $pilihProduk = Products::findOrFail($id);
        $pilihProduk->delete();

        return redirect()->route('index.products')->with('success', 'Berhasil hapus produk');
    }
}
