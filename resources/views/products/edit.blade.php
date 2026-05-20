@extends('layouts.app')

@section('title', 'Edit Produk')
@section('subtitle', 'Perbarui informasi produk Anda')
@section('sidebar_subtitle', 'Edit Produk')
@section('page_icon')
    <i class="fas fa-tshirt text-emerald-600"></i>
@endsection

@section('actions')
    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Daftar Produk</span>
    </a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
        <div class="border-b border-gray-100 px-6 py-4 bg-gradient-to-r from-amber-50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-pen text-amber-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-semibold text-gray-800">Form Edit Produk</h2>
                    <p class="text-xs text-gray-500">Ubah data produk yang diperlukan</p>
                </div>
            </div>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag text-emerald-500 mr-1"></i>
                    Nama Produk <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name"
                       value="{{ old('name', $product->name) }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori Produk - TAMBAHAN BARU -->
            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-layer-group text-emerald-500 mr-1"></i>
                    Kategori Produk
                </label>
                <select name="category_id" 
                        id="category_id" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition @error('category_id') border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            <i class="fas fa-tag"></i> {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-400 text-xs mt-1">Pilih kategori yang sesuai untuk produk ini</p>
            </div>

            <!-- Harga Produk -->
            <div>
                <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-rupiah-sign text-emerald-500 mr-1"></i>
                    Harga Produk <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                    <input type="number" 
                           name="price" 
                           id="price"
                           value="{{ old('price', $product->price) }}"
                           class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition @error('price') border-red-500 @enderror">
                </div>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stok Produk -->
            <div>
                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-boxes text-emerald-500 mr-1"></i>
                    Stok Produk
                </label>
                <input type="number" 
                       name="stock" 
                       id="stock"
                       value="{{ old('stock', $product->stock) }}"
                       min="0"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">
                <p class="text-gray-400 text-xs mt-1">Jumlah stok yang tersedia</p>
            </div>

            <!-- Foto Produk -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-image text-emerald-500 mr-1"></i>
                    Foto Produk
                </label>
                
                @if($product->image_url)
                <div class="mb-3">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                    <p class="text-gray-400 text-xs mt-1">Foto saat ini</p>
                </div>
                @endif
                
                <input type="file" 
                       name="image" 
                       id="image"
                       accept="image/*"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                <p class="text-gray-400 text-xs mt-1">Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG, GIF (Max 2MB)</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-align-left text-emerald-500 mr-1"></i>
                    Deskripsi Produk
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          placeholder="Jelaskan detail produk seperti kondisi, bahan, ukuran, dll..."
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">{{ old('description', $product->description) }}</textarea>
                <p class="text-gray-400 text-xs mt-1">Deskripsi yang baik akan meningkatkan kepercayaan pembeli</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl transition-all shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Update Produk</span>
                </button>
                <a href="{{ route('products.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-all font-medium flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Tombol Hapus -->
    <div class="mt-4">
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan!')">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full md:w-auto px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl transition-all flex items-center justify-center gap-2">
                <i class="fas fa-trash-alt"></i>
                <span>Hapus Produk</span>
            </button>
        </form>
        <p class="text-gray-400 text-xs mt-2">* Menghapus produk akan menghapus semua data terkait secara permanen</p>
    </div>
</div>
@endsection