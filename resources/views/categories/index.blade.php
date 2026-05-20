@extends('layouts.app')

@section('title', 'Data Kategori')
@section('subtitle', 'Kelola semua kategori produk thrift shop kamu')
@section('sidebar_subtitle', 'Manajemen Kategori')

@section('page_icon')
    <i class="fas fa-layer-group text-emerald-600"></i>
@endsection

@section('actions')
    <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl transition-all shadow-md hover:shadow-lg">
        <i class="fas fa-plus"></i>
        <span>Tambah Kategori</span>
    </a>
@endsection

@section('content')
    <!-- Card Table -->
    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $index => $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-gray-500 text-sm">{{ $categories->firstItem() + $index }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-tag text-emerald-600"></i>
                                </div>
                                <span class="font-medium text-gray-800">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($category->description)
                                <p class="text-gray-500 text-sm">{{ Str::limit($category->description, 50) }}</p>
                            @else
                                <span class="text-gray-400 text-sm italic">Tidak ada deskripsi</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                                <i class="fas fa-box"></i>
                                {{ $category->products_count ?? 0 }} Produk
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('categories.show', $category->id) }}" class="text-gray-500 hover:text-emerald-600 transition">
                                    <i class="fas fa-eye"></i>
                                    <span class="ml-1 text-sm">Detail</span>
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fas fa-edit"></i>
                                    <span class="ml-1 text-sm">Edit</span>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Semua produk dalam kategori ini akan kehilangan kategori.')">
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
                            <i class="fas fa-layer-group text-4xl mb-3 block"></i>
                            <p>Belum ada kategori. Silakan tambah kategori baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $categories->links() }}
    </div>

    <!-- Statistik tambahan -->
    <div class="mt-6 flex justify-between items-center text-sm text-gray-500">
        <div class="flex items-center gap-2">
            <i class="fas fa-chart-line text-emerald-500"></i>
            <span>Total kategori: <strong class="text-gray-800">{{ $categories->total() }}</strong></span>
        </div>
        <div>
            <i class="fas fa-arrow-left text-gray-400 mr-2"></i>
            <span class="hidden sm:inline">Gunakan tombol <strong>Tambah</strong> untuk menambahkan kategori baru</span>
        </div>
    </div>
@endsection