<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Thriftore - @yield('title')</title>

    <!-- Tailwind CSS + Font Awesome + Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 'inter': ['Inter', 'sans-serif'] },
                    colors: {
                        emerald: { 50: '#ecfdf5', 100: '#d1fae5', 500: '#10b981', 600: '#059669', 700: '#047857', 800: '#065f46' },
                        dark: '#1e293b', darker: '#0f172a',
                    },
                    boxShadow: {
                        'soft': '0 10px 25px -5px rgba(0,0,0,0.05)',
                        'card': '0 8px 20px rgba(0,0,0,0.03)',
                        'hover': '0 20px 30px -12px rgba(0,0,0,0.1)',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-transition {
            transition: all 0.25s ease;
        }

        .active-sidebar {
            background: linear-gradient(135deg, #10b98120 0%, #05966920 100%);
            border-left: 3px solid #10b981;
            color: #10b981;
        }

        .scrollbar-hide::-webkit-scrollbar {
            width: 5px;
        }

        .scrollbar-hide::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 10px;
        }

        .scrollbar-hide::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .sidebar-mobile {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                transition: transform 0.3s ease;
                height: 100vh;
                overflow-y: auto;
            }

            .sidebar-mobile.open {
                transform: translateX(0);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 font-inter antialiased">

    <!-- Mobile overlay & toggler -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>
    <button id="mobileMenuBtn"
        class="fixed bottom-6 right-6 bg-emerald-600 text-white p-3 rounded-full shadow-lg z-50 md:hidden hover:bg-emerald-700 transition">
        <i class="fas fa-bars text-xl"></i>
    </button>
    </button>
    @php
        use Illuminate\Support\Facades\Auth;

        $user = Auth::User();
    @endphp
    <div class="flex min-h-screen relative">
        <!-- ===================== SIDEBAR (DARK MODE) ===================== -->
        <aside id="sidebar"
            class="sidebar-mobile md:translate-x-0 w-72 bg-dark text-gray-200 flex-shrink-0 h-screen sticky top-0 overflow-y-auto scrollbar-hide z-40">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-store text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-white">Thrift<span
                            class="text-emerald-400">ore</span></span>
                </div>
                <p class="text-gray-400 text-xs mt-2">@yield('sidebar_subtitle', 'Admin Dashboard')</p>
            </div>

            <nav class="mt-6 px-4 space-y-1.5">
                @php
                    $activeMenu = $activeMenu ?? request()->segment(1);
                    $menuItems = [
                        ['name' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'route' => route('dashboard'), 'active_key' => 'dashboard'],
                        ['name' => 'Categories', 'icon' => 'fas fa-layer-group', 'route' => route('categories.index'), 'active_key' => 'categories'],
                        ['name' => 'Products', 'icon' => 'fas fa-tshirt', 'route' => route('products.index'), 'active_key' => 'products'],
                        ['name' => 'My Cart', 'icon' => 'fas fa-shopping-cart', 'route' => '/cart', 'active_key' => 'cart'],
                        ['name' => 'Cart Items', 'icon' => 'fas fa-boxes', 'route' => '/cart-items', 'active_key' => 'cart-items'],
                        ['name' => 'Orders', 'icon' => 'fas fa-truck', 'route' => '/orders', 'active_key' => 'orders'],
                        ['name' => 'Order Details', 'icon' => 'fas fa-receipt', 'route' => '/order-details', 'active_key' => 'order-details'],
                        ['name' => 'Payments', 'icon' => 'fas fa-credit-card', 'route' => '/payments', 'active_key' => 'payments'],
                        ['name' => 'Profile', 'icon' => 'fas fa-user-circle', 'route' => '/profile', 'active_key' => 'profile'],
                    ];
                @endphp

                @foreach($menuItems as $item)
                    <a href="{{ $item['route'] }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group hover:bg-gray-800 {{ ($activeMenu == $item['active_key']) ? 'active-sidebar bg-gray-800/60' : '' }}">
                        <i
                            class="{{ $item['icon'] }} w-5 text-gray-300 group-hover:text-emerald-400 {{ ($activeMenu == $item['active_key']) ? 'text-emerald-400' : '' }}"></i>
                        <span class="font-medium text-sm">{{ $item['name'] }}</span>
                        @if($activeMenu == $item['active_key'])
                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        @endif
                    </a>
                @endforeach

                <!-- Logout Section -->
                <div class="pt-6 mt-6 border-t border-gray-700">
                    <form action="{{ route('logout') }}" method="POST" id="logout-sidebar-form">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-4 px-4 py-3 rounded-xl text-red-300 hover:bg-gray-800 transition-all group"
                            onclick="return confirm('Yakin ingin logout dari Thriftore?')">
                            <i class="fas fa-sign-out-alt w-5 group-hover:text-red-400"></i>
                            <span class="font-medium text-sm group-hover:text-red-400">Logout</span>
                        </button>
                    </form>
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
                    <div class="flex items-center gap-4 md:hidden">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-store text-emerald-600 text-xl"></i>
                            <span class="font-bold text-dark">Thriftore</span>
                        </div>
                    </div>

                    <div class="flex-1 max-w-md w-full md:w-96">
                        <div class="relative">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" placeholder="Cari produk, kategori..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-11 pr-5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:border-transparent transition">
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="relative p-2 rounded-full text-gray-500 hover:bg-gray-100 transition">
                            <i class="far fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <div class="relative group">
                            <button class="flex items-center gap-2 focus:outline-none">
                                <img src="https://ui-avatars.com/api/?background=10b981&color=fff&name={{ session('username') }}&rounded=true&size=40"
                                    alt="Avatar" class="w-9 h-9 rounded-full object-cover border-2 border-white shadow">
                                <span
                                    class="hidden sm:inline text-sm font-medium text-gray-700">{{ session('username') }}</span>
                                <i
                                    class="fas fa-chevron-down hidden sm:inline text-xs text-gray-500 group-hover:rotate-180 transition"></i>
                            </button>
                            <div
                                class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="p-3 border-b border-gray-100">
                                    <p class="font-semibold text-gray-800">{{ session('username') }}</p>
                                    <p class="text-xs text-gray-500">{{ session('email') }}</p>
                                </div>
                                <a href="#"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"><i
                                        class="fas fa-user-circle w-5"></i> Profile</a>
                                <a href="#"
                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"><i
                                        class="fas fa-cog w-5"></i> Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Title & Breadcrumb -->
            <div class="px-6 md:px-8 pt-6 pb-2">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center gap-3">
                            @php
                                echo $__env->yieldContent('page_icon');
                            @endphp

                            @yield('title')
                        </h1>
                        <p class="text-gray-500 text-sm mt-1">
                            @yield('subtitle', 'Kelola data thrift shop Anda dengan mudah')</p>
                    </div>
                    @yield('actions')
                </div>
            </div>

            <!-- Alert Messages -->
            <div class="px-6 md:px-8">
                @if(session('success'))
                    <div
                        class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <div class="p-6 md:p-8 pt-4">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Mobile sidebar toggle script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobileOverlay');
        const menuBtn = document.getElementById('mobileMenuBtn');

        if (menuBtn) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('hidden');
                document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            });
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('open');
                if (overlay) overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
    </script>

    @stack('scripts')
</body>

</html>