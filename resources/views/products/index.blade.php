@extends('layouts.app')

@section('title', 'Data Product')
@section('subtitle', 'Kelola semua produk thrift shop kamu')
@section('sidebar_subtitle', 'Manajemen Produk')

@section('page_icon')
    <i class="fas fa-tshirt text-emerald-600"></i>
@endsection

@section('actions')
    <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
        <i class="fas fa-plus"></i>
        <span>Tambah Produk</span>
    </a>
@endsection

@section('content')
    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-box-open text-gray-500"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-medium text-gray-800">{{ $product->name }}</span>
                            @if($product->description)
                                <p class="text-xs text-gray-400 truncate max-w-xs">{{ Str::limit($product->description, 50) }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-semibold text-emerald-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->stock <= 0)
                                <span class="text-red-500 text-sm">Habis</span>
                            @elseif($product->stock <= 5)
                                <span class="text-orange-500 text-sm">Sisa {{ $product->stock }}</span>
                            @else
                                <span class="text-emerald-500 text-sm">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('products.show', $product->id) }}" class="text-gray-500 hover:text-emerald-600 transition">
                                    <i class="fas fa-eye"></i>
                                    <span class="ml-1 text-sm">Detail</span>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fas fa-edit"></i>
                                    <span class="ml-1 text-sm">Edit</span>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                        <i class="fas fa-trash-alt"></i>
                                        <span class="ml-1 text-sm">Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-box-open text-4xl mb-3 block"></i>
                            <p>Belum ada produk. Silakan tambah produk baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>

    <!-- Statistik tambahan -->
    <div class="mt-6 flex justify-between items-center text-sm text-gray-500">
        <div class="flex items-center gap-2">
            <i class="fas fa-chart-line text-emerald-500"></i>
            <span>Total produk: <strong class="text-gray-800">{{ $products->total() }}</strong></span>
        </div>
        <div>
            <i class="fas fa-arrow-left text-gray-400 mr-2"></i>
            <span class="hidden sm:inline">Gunakan tombol <strong>Tambah</strong> untuk menambahkan produk baru</span>
        </div>
    </div>
@endsection