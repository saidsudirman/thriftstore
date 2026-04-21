<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-pink-300 to-rose-400 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Register Akun
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
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

        <form method="POST" action="{{ route('register.process') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 text-sm mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none"
                    placeholder="Masukkan username" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none"
                    placeholder="Masukkan email" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none"
                    placeholder="Masukkan password" required>
            </div>

            <button type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg w-full transition">
                Register
            </button>

            <button type="reset"
                class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg transition">
                Batal
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-indigo-500 hover:underline font-medium">
                Login
            </a>
        </p>
    </div>
</body>
</html>