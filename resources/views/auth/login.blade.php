<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-300 to-rose-300 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Login Akun
        </h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('verify_link'))
            <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4 text-sm">
                Email verifikasi gagal dikirim. Untuk testing lokal, klik link ini:
                <a href="{{ session('verify_link') }}" class="underline font-semibold">Verifikasi akun</a>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 text-sm mb-1">Username / Email</label>
                <input type="text" name="login" value="{{ old('login') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Masukkan username atau email" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Masukkan password" required>
            </div>

            <button type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg w-full transition">
                Login
            </button>

            <button type="reset"
                class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg transition">
                Batal
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline font-medium">
                Register
            </a>
        </p>
    </div>
</body>
</html>