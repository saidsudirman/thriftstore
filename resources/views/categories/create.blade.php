@extends('layouts.app')

@section('title', 'Tambah Kategori Baru')
@section('subtitle', 'Isi formulir di bawah ini untuk menambahkan kategori produk baru')
@section('sidebar_subtitle', 'Tambah Kategori')
@section('page_icon')
    <i class="fas fa-layer-group text-emerald-600"></i>
@endsection

@section('actions')
    <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Daftar Kategori</span>
    </a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
        <div class="border-b border-gray-100 px-6 py-4 bg-gradient-to-r from-emerald-50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-layer-group text-emerald-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-semibold text-gray-800">Form Tambah Kategori</h2>
                    <p class="text-xs text-gray-500">Lengkapi data kategori dengan benar</p>
                </div>
            </div>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Nama Kategori -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag text-emerald-500 mr-1"></i>
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Pakaian Pria, Pakaian Wanita, Aksesoris, Sepatu, Tas"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
                <p class="text-gray-400 text-xs mt-1">Nama kategori harus unik dan mudah dikenali</p>
            </div>

            <!-- Deskripsi Kategori -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-align-left text-emerald-500 mr-1"></i>
                    Deskripsi Kategori
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          placeholder="Jelaskan deskripsi kategori ini..."
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">{{ old('description') }}</textarea>
                <p class="text-gray-400 text-xs mt-1">Deskripsi akan membantu pembeli memahami jenis produk dalam kategori ini</p>
            </div>

            <!-- Informasi Tambahan -->
            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-info-circle text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800 text-sm">Informasi</h4>
                        <p class="text-gray-600 text-xs mt-1">
                            Kategori akan digunakan untuk mengelompokkan produk. Setelah kategori dibuat, Anda bisa memilihnya saat menambah atau mengedit produk.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl transition-all shadow-md hover:shadow-lg font-semibold flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan Kategori</span>
                </button>
                <a href="{{ route('categories.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-all font-medium flex items-center gap-2">
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
                <h4 class="font-semibold text-gray-800 text-sm">Tips Kategori yang Baik</h4>
                <p class="text-gray-600 text-xs mt-1">
                    Gunakan nama kategori yang spesifik dan mudah dipahami. Kategori yang terlalu umum akan menyulitkan pembeli menemukan produk yang mereka cari.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection