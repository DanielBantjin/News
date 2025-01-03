<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-black to-gray-900">
    <div class="w-full max-w-none md:max-w-lg bg-white rounded-lg shadow-lg p-8 md:w-11/12 lg:w-9/12">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Daftar</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                       required>
            </div>

            <!-- Place of Birth -->
            <div>
                <label for="birthplace" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="birthplace" id="birthplace" value="{{ old('birthplace') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                       required>
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="birthdate" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                       required>
            </div>

            <!-- Age -->
            <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Umur</label>
                <input type="number" name="age" id="age" value="{{ old('age') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                       required>
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="gender" id="gender" 
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                        required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                       required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                       required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" name="password" id="password"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                       required>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500" 
                       required>
            </div>

            <!-- Register Button -->
            <div class="flex flex-col gap-4">
                <button type="submit" 
                        class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition duration-300">
                    Daftar
                </button>
                <a href="{{ route('login') }}" 
                   class="w-full text-center bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300">
                    Kembali ke Login
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
