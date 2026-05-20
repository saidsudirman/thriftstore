@extends('layouts.app')

@section('title', 'Tambah Produk Baru')
@section('subtitle', 'Isi formulir di bawah ini untuk menambahkan produk baru ke toko Anda')
@section('sidebar_subtitle', 'Tambah Produk')
@section('page_icon')
    <i class="fas fa-tshirt text-emerald-600"></i>
@endsection

@section('actions')
    <a href="{{ route('products.index') }}"
        class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Daftar Produk</span>
    </a>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 px-6 py-4 bg-gradient-to-r from-emerald-50 to-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-box-open text-emerald-600 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-800">Form Tambah Produk</h2>
                        <p class="text-xs text-gray-500">Lengkapi data produk dengan benar</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <!-- Nama Produk -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-tag text-emerald-500 mr-1"></i>
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="Contoh: Vintage Denim Jacket, Oversized Tee, dll."
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Harga Produk -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-rupiah-sign text-emerald-500 mr-1"></i>
                        Harga Produk <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" placeholder="0"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition @error('price') border-red-500 @enderror">
                    </div>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Stok Produk -->
                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-boxes text-emerald-500 mr-1"></i>
                        Stok Produk
                    </label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">
                    <p class="text-gray-400 text-xs mt-1">Jumlah stok yang tersedia</p>
                </div>
                <!-- Category ID -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">

                        <i class="fas fa-layer-group text-emerald-500 mr-1"></i>

                        Category ID
                        <span class="text-red-500">*</span>

                    </label>

                    <input type="number" name="category_id" id="category_id" value="{{ old('category_id') }}"
                        placeholder="Masukkan ID kategori" class="w-full px-4 py-3 border border-gray-200 rounded-xl">

                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Foto Produk -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image text-emerald-500 mr-1"></i>
                        Foto Produk
                    </label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="text-gray-400 text-xs mt-1">Format: JPG, PNG, GIF (Max 2MB)</p>
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
                    <textarea name="description" id="description" rows="4"
                        placeholder="Jelaskan detail produk seperti kondisi, bahan, ukuran, dll..."
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">{{ old('description') }}</textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="submit"
                        class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl transition-all shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Simpan Produk</span>
                    </button>
                    <a href="{{ route('products.index') }}"
                        class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-all font-medium flex items-center gap-2">
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Tips Card -->
        <div class="mt-6 bg-gradient-to-r from-emerald-50 to-white rounded-xl p-4 border border-emerald-100">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lightbulb text-emerald-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 text-sm">Tips Menjual di Thriftore</h4>
                    <p class="text-gray-600 text-xs mt-1">
                        Gunakan nama produk yang menarik, foto berkualitas, dan deskripsi yang jujur mengenai kondisi
                        barang.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection