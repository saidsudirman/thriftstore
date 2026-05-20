<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Thriftore - Dashboard User</title>
    <!-- Tailwind CSS + Font Awesome + Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Custom config Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                        dark: '#1e293b',
                        darker: '#0f172a',
                    },
                    boxShadow: {
                        'soft': '0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02)',
                        'card': '0 8px 20px rgba(0,0,0,0.03), 0 2px 4px rgba(0,0,0,0.05)',
                        'hover': '0 20px 30px -12px rgba(0, 0, 0, 0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        .sidebar-transition { transition: all 0.25s ease-in-out; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.12); }
        .active-sidebar { background: linear-gradient(135deg, #10b98120 0%, #05966920 100%); border-left: 3px solid #10b981; color: #10b981; }
        .scrollbar-hide::-webkit-scrollbar { width: 5px; }
        .scrollbar-hide::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .scrollbar-hide::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        @media (max-width: 768px) {
            .sidebar-mobile { transform: translateX(-100%); position: fixed; z-index: 50; transition: transform 0.3s ease; }
            .sidebar-mobile.open { transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-gray-50 font-inter antialiased">

    <!-- Mobile overlay & toggler -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>
    <button id="mobileMenuBtn" class="fixed bottom-6 right-6 bg-emerald-600 text-white p-3 rounded-full shadow-lg z-50 md:hidden">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <div class="flex min-h-screen relative">
        <!-- ===================== SIDEBAR (DARK MODE) ===================== -->
        <aside id="sidebar" class="sidebar-mobile md:translate-x-0 w-72 bg-dark text-gray-200 flex-shrink-0 h-screen sticky top-0 overflow-y-auto scrollbar-hide z-40">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-store text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-white">Thrift<span class="text-emerald-400">ore</span></span>
                </div>
                <p class="text-gray-400 text-xs mt-2">User Dashboard</p>
            </div>

            <nav class="mt-6 px-4 space-y-1.5">
                @php
                    $activeMenu = 'dashboard';
                    $menuItems = [
                        ['name' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'route' => '#', 'active' => 'dashboard'],
                        ['name' => 'Categories', 'icon' => 'fas fa-layer-group', 'route' => '#', 'active' => 'categories'],
                        ['name' => 'Products', 'icon' => 'fas fa-tshirt', 'route' => '#', 'active' => 'products'],
                        ['name' => 'My Cart', 'icon' => 'fas fa-shopping-cart', 'route' => '#', 'active' => 'mycart'],
                        ['name' => 'Cart Items', 'icon' => 'fas fa-boxes', 'route' => '#', 'active' => 'cartitems'],
                        ['name' => 'Orders', 'icon' => 'fas fa-truck', 'route' => '#', 'active' => 'orders'],
                        ['name' => 'Order Details', 'icon' => 'fas fa-receipt', 'route' => '#', 'active' => 'orderdetails'],
                        ['name' => 'Payments', 'icon' => 'fas fa-credit-card', 'route' => '#', 'active' => 'payments'],
                        ['name' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => '#', 'active' => 'profile'],
                    ];
                @endphp
                @foreach($menuItems as $item)
                    <a href="{{ $item['route'] }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group hover:bg-gray-800 {{ $activeMenu === $item['active'] ? 'active-sidebar bg-gray-800/60' : '' }}">
                        <i class="{{ $item['icon'] }} w-5 text-gray-300 group-hover:text-emerald-400 {{ $activeMenu === $item['active'] ? 'text-emerald-400' : '' }}"></i>
                        <span class="font-medium text-sm">{{ $item['name'] }}</span>
                        @if($activeMenu === $item['active'])
                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        @endif
                    </a>
                @endforeach

                <!-- Logout terpisah dengan border top -->
                <div class="pt-6 mt-6 border-t border-gray-700">
                    <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl text-red-300 hover:bg-gray-800 transition-all">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="font-medium text-sm">Logout</span>
                    </a>
                </div>
            </nav>
            <div class="p-5 mt-6 text-center text-gray-500 text-xs">
                <i class="far fa-heart text-emerald-600"></i> Thriftore v2.0
            </div>
        </aside>

        <!-- ===================== MAIN CONTENT ===================== -->
        <main class="flex-1 overflow-x-hidden">
            <!-- Top Navbar -->
            <header class="bg-white/80 backdrop-blur-sm sticky top-0 z-30 border-b border-gray-100 shadow-sm">
                <div class="flex items-center justify-between px-6 md:px-8 py-3 gap-4 flex-wrap">
                    <!-- Logo mobile + search -->
                    <div class="flex items-center gap-4 md:hidden">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-store text-emerald-600 text-xl"></i>
                            <span class="font-bold text-dark">Thriftore</span>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="flex-1 max-w-md w-full md:w-96">
                        <div class="relative">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" placeholder="Cari produk, kategori..." class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-11 pr-5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">
                        </div>
                    </div>

                    <!-- Notifikasi + Profile -->
                    <div class="flex items-center gap-3">
                        <button class="relative p-2 rounded-full text-gray-500 hover:bg-gray-100 transition">
                            <i class="far fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <div class="relative group">
                            <button class="flex items-center gap-2 focus:outline-none">
                                <img src="https://ui-avatars.com/api/?background=10b981&color=fff&name=Ayu+Putri&rounded=true&size=40" alt="Avatar" class="w-9 h-9 rounded-full object-cover border-2 border-white shadow">
                                <span class="hidden sm:inline text-sm font-medium text-gray-700">Ayu Putri</span>
                                <i class="fas fa-chevron-down hidden sm:inline text-xs text-gray-500 group-hover:rotate-180 transition"></i>
                            </button>
                            <!-- Dropdown -->
                            <div class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="p-3 border-b border-gray-100">
                                    <p class="font-semibold text-gray-800">Ayu Putri</p>
                                    <p class="text-xs text-gray-500">ayup@thriftore.com</p>
                                </div>
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"><i class="fas fa-user-circle w-5"></i> Profile</a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"><i class="fas fa-cog w-5"></i> Settings</a>
                                <div class="border-t"><a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600"><i class="fas fa-sign-out-alt w-5"></i> Logout</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Dashboard -->
            <div class="p-5 md:p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                    <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, <span class="font-medium text-gray-700">Ayu!</span> Kelola thrift shop kamu lebih mudah.</p>
                </div>

                <!-- Statistic Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-10">
                    @php
                        $stats = [
                            ['label' => 'Total Products', 'value' => '248', 'icon' => 'fa-tshirt', 'color' => 'bg-emerald-100 text-emerald-700', 'bg' => 'from-emerald-50 to-white'],
                            ['label' => 'Total Categories', 'value' => '12', 'icon' => 'fa-layer-group', 'color' => 'bg-blue-100 text-blue-700', 'bg' => 'from-blue-50 to-white'],
                            ['label' => 'Total Cart Items', 'value' => '8', 'icon' => 'fa-shopping-cart', 'color' => 'bg-amber-100 text-amber-700', 'bg' => 'from-amber-50 to-white'],
                            ['label' => 'Total Orders', 'value' => '36', 'icon' => 'fa-truck', 'color' => 'bg-purple-100 text-purple-700', 'bg' => 'from-purple-50 to-white'],
                            ['label' => 'Total Payments', 'value' => 'Rp 24.5jt', 'icon' => 'fa-credit-card', 'color' => 'bg-rose-100 text-rose-700', 'bg' => 'from-rose-50 to-white'],
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
                            <div class="mt-3 text-xs text-emerald-600 font-medium flex items-center gap-1"><i class="fas fa-chart-line"></i> +12% dari bulan lalu</div>
                        </div>
                    @endforeach
                </div>

                <!-- Dua Kolom: Produk Terbaru & Recent Orders -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Produk Terbaru -->
                    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold text-gray-800"><i class="fas fa-fire text-orange-500 mr-2"></i> Produk Terbaru</h2>
                            <a href="#" class="text-emerald-600 text-sm font-medium hover:underline">Lihat semua <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                        <div class="space-y-4">
                            @php
                                $recentProducts = [
                                    ['name' => 'Vintage Denim Jacket', 'price' => 'Rp 289.000', 'category' => 'Jaket', 'image' => 'https://placehold.co/400x400/2d2d2d/white?text=Jacket', 'badge' => 'Best Seller'],
                                    ['name' => 'Oversized White Tee', 'price' => 'Rp 99.000', 'category' => 'Kaos', 'image' => 'https://placehold.co/400x400/1e293b/white?text=T-Shirt', 'badge' => 'New'],
                                    ['name' => 'Y2K Cargo Pants', 'price' => 'Rp 210.000', 'category' => 'Celana', 'image' => 'https://placehold.co/400x400/334155/white?text=Cargo', 'badge' => 'Trending'],
                                    ['name' => 'Thrift Sneakers', 'price' => 'Rp 450.000', 'category' => 'Sepatu', 'image' => 'https://placehold.co/400x400/0f172a/white?text=Shoes', 'badge' => 'Limited'],
                                ];
                            @endphp
                            @foreach($recentProducts as $product)
                            <div class="flex items-center gap-4 p-2 rounded-xl hover:bg-gray-50 transition group">
                                <div class="w-14 h-14 rounded-xl bg-gray-200 flex items-center justify-center overflow-hidden">
                                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h4 class="font-semibold text-gray-800">{{ $product['name'] }}</h4>
                                        <span class="text-[10px] bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-medium">{{ $product['badge'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-gray-500 mt-1">
                                        <i class="fas fa-tag"></i> {{ $product['category'] }}
                                    </div>
                                    <p class="text-emerald-700 font-bold text-sm mt-1">{{ $product['price'] }}</p>
                                </div>
                                <button class="bg-gray-100 hover:bg-emerald-600 hover:text-white text-gray-700 p-2 rounded-full transition-all w-9 h-9 flex items-center justify-center"><i class="fas fa-cart-plus text-xs"></i></button>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-5 pt-3 text-center">
                            <button class="text-emerald-600 text-sm font-medium inline-flex items-center gap-1">Tambah ke keranjang cepat <i class="fas fa-chevron-right text-[10px]"></i></button>
                        </div>
                    </div>

                    <!-- Recent Orders Table -->
                    <div class="bg-white rounded-2xl shadow-soft border border-gray-100 p-5">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold text-gray-800"><i class="fas fa-clock text-gray-500 mr-2"></i> Pesanan Terbaru</h2>
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
                                        <td class="py-3"><span class="inline-flex px-2 py-1 rounded-full text-[11px] font-semibold {{ $order['statusColor'] }}">{{ $order['status'] }}</span></td>
                                        <td class="py-3 font-semibold text-gray-800">{{ $order['total'] }}</td>
                                        <td class="py-3 text-gray-500 text-xs">{{ $order['date'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 p-3 bg-gray-50 rounded-xl flex justify-between items-center text-xs text-gray-500">
                            <span><i class="fas fa-truck-fast mr-1 text-emerald-500"></i> 3 pesanan dalam proses pengiriman</span>
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
                    <button class="mt-3 sm:mt-0 bg-emerald-600 text-white px-5 py-2 rounded-xl text-sm font-semibold shadow-md hover:bg-emerald-700 transition">Jelajahi Sekarang <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>
        </main>
    </div>

    <!-- Mobile sidebar toggle script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobileOverlay');
        const menuBtn = document.getElementById('mobileMenuBtn');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        });
        window.addEventListener('resize', () => {
            if(window.innerWidth >= 768) {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    </script>
</body>
</html>