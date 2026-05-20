@extends('layouts.app')

@section('title', 'Detail Kategori')
@section('subtitle', 'Informasi lengkap kategori produk')
@section('sidebar_subtitle', 'Detail Kategori')
@section('page_icon')
    <i class="fas fa-layer-group text-emerald-600"></i>
@endsection

@section('actions')
    <div class="flex gap-2">
        <a href="{{ route('categories.edit', $category->id) }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition-all">
            <i class="fas fa-edit"></i>
            <span>Edit</span>
        </a>
        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-xl transition-all">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-6 border-b border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-layer-group text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $category->name }}</h1>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-xs text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i>
                            Dibuat: {{ $category->created_at ? $category->created_at->format('d M Y') : '-' }}
                        </span>
                        <span class="text-xs text-gray-500">
                            <i class="fas fa-edit mr-1"></i>
                            Update: {{ $category->updated_at ? $category->updated_at->format('d M Y') : '-' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Deskripsi -->
            <div>
                <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-align-left text-emerald-500"></i>
                    Deskripsi
                </h3>
                <div class="bg-gray-50 rounded-xl p-4">
                    @if($category->description)
                        <p class="text-gray-600 leading-relaxed">{{ $category->description }}</p>
                    @else
                        <p class="text-gray-400 italic">Tidak ada deskripsi untuk kategori ini.</p>
                    @endif
                </div>
            </div>

            <!-- Statistik Produk -->
            <div>
                <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-boxes text-emerald-500"></i>
                    Statistik Produk
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-emerald-50 to-white rounded-xl p-4 border border-emerald-100 text-center">
                        <i class="fas fa-box text-emerald-600 text-2xl mb-2 block"></i>
                        <p class="text-2xl font-bold text-gray-800">{{ $category->products_count ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Total Produk</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-blue-100 text-center">
                        <i class="fas fa-tag text-blue-600 text-2xl mb-2 block"></i>
                        <p class="text-2xl font-bold text-gray-800">{{ $category->name }}</p>
                        <p class="text-xs text-gray-500">Nama Kategori</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-white rounded-xl p-4 border border-purple-100 text-center">
                        <i class="fas fa-hashtag text-purple-600 text-2xl mb-2 block"></i>
                        <p class="text-2xl font-bold text-gray-800">#{{ $category->id }}</p>
                        <p class="text-xs text-gray-500">ID Kategori</p>
                    </div>
                </div>
            </div>

            <!-- Daftar Produk dalam Kategori ini -->
            @if(isset($category->products) && $category->products->count() > 0)
            <div>
                <h3 class="font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-tshirt text-emerald-500"></i>
                    Produk dalam Kategori Ini
                </h3>
                <div class="bg-gray-50 rounded-xl overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-500">Nama Produk</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-500">Harga</th>
                                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-500">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($category->products as $product)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $product->name }}</td>
                                <td class="px-4 py-2 text-sm text-emerald-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 text-sm">{{ $product->stock }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection