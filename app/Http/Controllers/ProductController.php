<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('products', $imageName, 'public');
            $data['image'] = '/storage/' . $imagePath; // Pakai 'image'
        }

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk "' . $request->name . '" berhasil ditambahkan');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

 public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = category::all(); // Ambil semua kategori
        
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // VALIDASI - tambahkan category_id
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id', // TAMBAHKAN
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // DATA UPDATE - tambahkan category_id
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id, // TAMBAHKAN
        ];

        // CEK JIKA ADA GAMBAR BARU
        if ($request->hasFile('image')) {
            // HAPUS GAMBAR LAMA
            if ($product->image_url && Storage::disk('public')->exists(str_replace('/storage/', '', $product->image_url))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image_url));
            }

            // UPLOAD GAMBAR BARU
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('products', $imageName, 'public');
            $data['image_url'] = '/storage/' . $imagePath;
        }

        // UPDATE
        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists(str_replace('/storage/', '', $product->image))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
        }

        $productName = $product->name;
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk "' . $productName . '" berhasil dihapus');
    }
}