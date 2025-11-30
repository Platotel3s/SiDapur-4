<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'slug' => 'string',
        ]);
        Categories::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('create.categories')->with('success', 'Berhasil tambah kategori');
    }

    public function edit(Request $request, string $id)
    {
        $selectedCategory = Categories::findOrFail($id);

        return view('admin.categories.edit', compact('selectedCategory'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'nullable',
            'slug' => 'nullable',
        ]);
        $pilihCategory = Categories::findOrFail($id);
        $pilihCategory->update();

        return redirect()->route('index.categories')->with('success', 'Berhasil memperbarui');
    }

    public function destroy(string $id)
    {
        $selectedCategory = Categories::findOrFail($id);
        $selectedCategory->delete();

        return redirect()->route('index.categories')->with('success', $selectedCategory->name.' Berhasil hapus');
    }
}
