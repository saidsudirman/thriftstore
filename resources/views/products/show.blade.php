@extends('layouts.app')

@section('title', 'Detail Produk')
@section('subtitle', 'Informasi lengkap produk')
@section('sidebar_subtitle', 'Detail Produk')
@section('page_icon')
    <i class="fas fa-tshirt text-emerald-600"></i>
@endsection

@section('actions')
    <div class="flex gap-2">
        <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition-all">
            <i class="fas fa-edit"></i>
            <span>Edit</span>
        </a>
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-xl transition-all">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
        <div class="grid md:grid-cols-2 gap-6 p-6">
            <!-- Foto Produk - DIPERBAIKI -->
            <div class="bg-gray-50 rounded-xl flex items-center justify-center p-6 min-h-[300px]">
                @php
                    // Cek beberapa kemungkinan field gambar
                    $imageUrl = null;
                    
                    // Coba ambil dari image_url
                    if(isset($product->image_url) && $product->image_url) {
                        $imageUrl = $product->image_url;
                    }
                    // Coba ambil dari image (tanpa underscore)
                    elseif(isset($product->image) && $product->image) {
                        $imageUrl = $product->image;
                    }
                    // Coba cek apakah ada file gambar di storage
                    else {
                        // Cek apakah ada gambar dengan nama berdasarkan ID
                        $possibleImage = '/storage/products/' . $product->id . '.jpg';
                        if(file_exists(public_path($possibleImage))) {
                            $imageUrl = $possibleImage;
                        }
                    }
                    
                    // Pastikan URL gambar valid
                    $imageUrl = $imageUrl ? asset($imageUrl) : null;
                @endphp
                
                @if($imageUrl)
                    <img src="{{ $imageUrl }}" 
                         alt="{{ $product->name }}" 
                         class="max-w-full h-auto max-h-80 rounded-lg object-contain"
                         onerror="this.onerror=null; this.src='https://placehold.co/400x400/e2e8f0/64748b?text=No+Image&font=montserrat'; this.classList.add('fallback-image')">
                @else
                    <div class="w-full h-80 bg-gray-100 rounded-xl flex flex-col items-center justify-center">
                        <i class="fas fa-image text-6xl text-gray-300"></i>
                        <p class="text-gray-400 mt-2">Tidak ada foto</p>
                        <p class="text-gray-300 text-xs mt-1">Upload foto untuk tampilan lebih baik</p>
                    </div>
                @endif
            </div>

            <!-- Informasi Produk -->
            <div class="space-y-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <div class="flex flex-col gap-3 text-sm">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-boxes text-gray-400 w-5"></i>
                            <span class="text-gray-600">Stok:</span>
                            @if(($product->stock ?? 0) <= 0)
                                <span class="text-red-500 font-semibold">Habis</span>
                            @elseif(($product->stock ?? 0) <= 5)
                                <span class="text-orange-500 font-semibold">Sisa {{ $product->stock }}</span>
                            @else
                                <span class="text-emerald-500 font-semibold">{{ $product->stock }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar text-gray-400 w-5"></i>
                            <span class="text-gray-600">Dibuat:</span>
                            <span>{{ $product->created_at ? $product->created_at->format('d M Y') : '-' }}</span>
                        </div>
                        @if($product->category_id)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-layer-group text-gray-400 w-5"></i>
                            <span class="text-gray-600">Kategori:</span>
                            <span class="text-gray-700">{{ $product->category->name ?? 'Tidak ada kategori' }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                @if($product->description)
                <div class="border-t border-gray-100 pt-4">
                    <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <i class="fas fa-align-left text-emerald-500"></i>
                        Deskripsi
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $product->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection