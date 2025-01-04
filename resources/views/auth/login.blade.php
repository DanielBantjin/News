<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Winnicode Garuda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-black min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="text-2xl font-bold mb-6 text-center">Login ke Winnicode Garuda</h1>

        <!-- Pesan Error -->
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif
        
        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full px-4 py-2 bg-gray-700 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 bg-gray-700 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Tombol Login -->
            <button type="submit" 
                    class="w-full py-2 bg-purple-600 hover:bg-purple-700 rounded-lg font-medium transition duration-300">
                Login
            </button>
        </form>

        <!-- Link ke Registrasi -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-400">Belum punya akun?</p>
            <a href="{{ route('register') }}" 
               class="text-purple-400 hover:text-purple-500 font-medium transition duration-300">
                Daftar Sekarang
            </a>
        </div>
    </div>
</body>
</html>
