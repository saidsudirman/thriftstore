<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // SIMPAN DATA
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Detail kategori
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
    }

    /**
     * Form edit kategori
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        // VALIDASI
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        // CARI DATA
        $category = Category::findOrFail($id);

        // UPDATE
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}