@extends('layouts.app')

@section('title', 'Dashboard Overview')
@section('subtitle', 'Kelola thrift shop kamu lebih mudah')
@section('sidebar_subtitle', 'User Dashboard')
@section('page_icon')
    <i class="fas fa-tachometer-alt text-emerald-600"></i>
@endsection

@section('content')
<!-- Statistic Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-10">
    @php
        $stats = [
            ['label' => 'Total Products', 'value' => '248', 'icon' => 'fa-tshirt', 'color' => 'bg-emerald-100 text-emerald-700'],
            ['label' => 'Total Categories', 'value' => '12', 'icon' => 'fa-layer-group', 'color' => 'bg-blue-100 text-blue-700'],
            ['label' => 'Total Cart Items', 'value' => '8', 'icon' => 'fa-shopping-cart', 'color' => 'bg-amber-100 text-amber-700'],
            ['label' => 'Total Orders', 'value' => '36', 'icon' => 'fa-truck', 'color' => 'bg-purple-100 text-purple-700'],
            ['label' => 'Total Payments', 'value' => 'Rp 24.5jt', 'icon' => 'fa-credit-card', 'color' => 'bg-rose-100 text-rose-700'],
        ];
    @endphp
    @foreach($stats as $stat)
        <div class="bg-white rounded-2xl shadow-card border border-gray-100 p-5 transition-all duration-300 card-hover">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm font-medium">{{ $stat['label'] }}</p>
                    <p class="text-2xl font-extrabold text-gray-800 mt-1">{{ $stat['value'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl {{ $stat['color'] }} flex items-center justify-center">
                    <i class="fas {{ $stat['icon'] }} text-lg"></i>
                </div>
            </div>
            <div class="mt-3 text-xs text-emerald-600 font-medium flex items-center gap-1">
                <i class="fas fa-chart-line"></i> +12% dari bulan lalu
            </div>
        </div>
    @endforeach
</div>

<!-- Dua Kolom: Produk Terbaru & Recent Orders -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Produk Terbaru -->
    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-fire text-orange-500 mr-2"></i> Produk Terbaru
            </h2>
            <a href="{{ route('products.index') }}" class="text-emerald-600 text-sm font-medium hover:underline">
                Lihat semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="space-y-4">
            @php
                $recentProducts = \App\Models\Product::latest()->take(4)->get();
            @endphp
            
            @forelse($recentProducts as $product)
            <div class="flex items-center gap-4 p-2 rounded-xl hover:bg-gray-50 transition group">
                <div class="w-14 h-14 rounded-xl bg-gray-200 flex items-center justify-center overflow-hidden">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-tshirt text-gray-400 text-2xl"></i>
                    @endif
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 class="font-semibold text-gray-800">{{ $product->name }}</h4>
                        <span class="text-[10px] bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-medium">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mt-1">
                        <i class="fas fa-tag"></i> Stok: {{ $product->stock }}
                    </div>
                    <p class="text-emerald-700 font-bold text-sm mt-1">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
                <button class="bg-gray-100 hover:bg-emerald-600 hover:text-white text-gray-700 p-2 rounded-full transition-all w-9 h-9 flex items-center justify-center">
                    <i class="fas fa-cart-plus text-xs"></i>
                </button>
            </div>
            @empty
            <div class="text-center py-8 text-gray-400">
                <i class="fas fa-box-open text-4xl mb-2 block"></i>
                <p>Belum ada produk</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 p-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-gray-800">
                <i class="fas fa-clock text-gray-500 mr-2"></i> Pesanan Terbaru
            </h2>
            <a href="#" class="text-emerald-600 text-sm">Lihat history</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-gray-100">
                    <tr class="text-left text-gray-500">
                        <th class="pb-3 font-semibold">No. Order</th>
                        <th class="pb-3 font-semibold">Status</th>
                        <th class="pb-3 font-semibold">Total</th>
                        <th class="pb-3 font-semibold">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $orders = [
                            ['id' => '#TR-10234', 'status' => 'Delivered', 'total' => 'Rp 349.000', 'date' => '12 Apr 2025', 'statusColor' => 'bg-emerald-100 text-emerald-700'],
                            ['id' => '#TR-10235', 'status' => 'Processing', 'total' => 'Rp 129.000', 'date' => '14 Apr 2025', 'statusColor' => 'bg-amber-100 text-amber-700'],
                            ['id' => '#TR-10236', 'status' => 'Shipped', 'total' => 'Rp 775.000', 'date' => '15 Apr 2025', 'statusColor' => 'bg-blue-100 text-blue-700'],
                            ['id' => '#TR-10237', 'status' => 'Completed', 'total' => 'Rp 2.150.000', 'date' => '16 Apr 2025', 'statusColor' => 'bg-emerald-100 text-emerald-700'],
                        ];
                    @endphp
                    @foreach($orders as $order)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-3 font-medium text-gray-800">{{ $order['id'] }}</td>
                        <td class="py-3">
                            <span class="inline-flex px-2 py-1 rounded-full text-[11px] font-semibold {{ $order['statusColor'] }}">
                                {{ $order['status'] }}
                            </span>
                        </td>
                        <td class="py-3 font-semibold text-gray-800">{{ $order['total'] }}</td>
                        <td class="py-3 text-gray-500 text-xs">{{ $order['date'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 p-3 bg-gray-50 rounded-xl flex justify-between items-center text-xs text-gray-500">
            <span>
                <i class="fas fa-truck-fast mr-1 text-emerald-500"></i> 3 pesanan dalam proses pengiriman
            </span>
            <span class="font-medium">Total pendapatan bulan ini: Rp 5.6jt</span>
        </div>
    </div>
</div>

<!-- Tambahan bagian ringkasan produk thrift -->
<div class="mt-10 bg-gradient-to-r from-emerald-50 to-white rounded-2xl p-6 flex flex-col sm:flex-row justify-between items-center shadow-sm border border-emerald-100">
    <div>
        <h3 class="font-bold text-gray-800 text-lg">✨ Thrift Market is booming!</h3>
        <p class="text-gray-600 text-sm mt-1">Jelajahi koleksi vintage terbaru dan dapatkan diskon hingga 50%</p>
    </div>
    <button class="mt-3 sm:mt-0 bg-emerald-600 text-white px-5 py-2 rounded-xl text-sm font-semibold shadow-md hover:bg-emerald-700 transition">
        Jelajahi Sekarang <i class="fas fa-arrow-right ml-1"></i>
    </button>
</div>
@endsection

@push('styles')
<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.12);
    }
</style>
@endpush