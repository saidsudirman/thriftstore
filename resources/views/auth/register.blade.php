<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-500 to-purple-600 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Buat Akun Baru
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
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

        <form method="POST" action="/register" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 text-sm mb-1">Username</label>
                <input type="text" name="username"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    placeholder="Masukkan username" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    placeholder="Masukkan email" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    placeholder="Masukkan password" required>
            </div>

            <button type="submit"
                class="w-full bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded-lg transition">
                Register
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun?
            <a href="/login" class="text-indigo-500 hover:underline font-medium">
                Login
            </a>
        </p>

    </div>

</body>
</html>