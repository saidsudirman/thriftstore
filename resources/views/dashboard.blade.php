<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-lg text-center">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold text-green-700 mb-3">Dashboard Aplikasi Anda</h1>
        <p class="text-gray-700 text-lg mb-2">
            Selamat datang pada aplikasi <span class="font-bold">Thrift Toko YBD</span>
        </p>
        <p class="text-gray-600 mb-6">
            Halo, {{ session('username') }}
        </p>

        <a href="{{ route('logout') }}"
            class="inline-block bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition">
            Logout
        </a>
    </div>
</body>
</html>