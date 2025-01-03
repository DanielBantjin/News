@extends('layouts.app')

@section('title', 'Edit Profil Saya')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-black to-gray-900 py-20">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Edit Profil Saya</h2>

            <!-- Form Edit Profile -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input Foto Profil -->
                <div class="col-span-2 flex items-center gap-4">
                    <div>
                        <img src="{{ Auth::user()->profile_picture_url ?? asset('images/default-profile.png') }}"
                            alt="Foto Profil" class="w-20 h-20 rounded-full">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload Foto Profil</label>
                        <input type="file" name="profile_picture"
                            class="mt-2 block w-full text-sm text-gray-600 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    </div>
                </div>

                <!-- Full Name -->
                <div class="col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500"
                        required>
                </div>

                <!-- Username -->
                <div class="col-span-2">
                    <label for="username" class="block text-sm font-medium text-gray-700">User Name</label>
                    <input type="text" name="username" id="username"
                        value="{{ old('username', Auth::user()->username) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500"
                        required>
                </div>

                <!-- Email -->
                <div class="col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500"
                        required>
                </div>

                <!-- Contact -->
                <div class="col-span-2">
                    <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="text" name="contact" id="contact" value="{{ old('contact', Auth::user()->contact) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <!-- Birthplace -->
                <div class="col-span-2">
                    <label for="birthplace" class="block text-sm font-medium text-gray-700">Birthplace</label>
                    <input type="text" name="birthplace" id="birthplace"
                        value="{{ old('birthplace', Auth::user()->birthplace) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <!-- Birthdate -->
                <div class="col-span-2">
                    <label for="birthdate" class="block text-sm font-medium text-gray-700">Birthdate</label>
                    <input type="date" name="birthdate" id="birthdate"
                        value="{{ old('birthdate', Auth::user()->birthdate) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <!-- Gender -->
                <div class="col-span-2">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Select Gender</option>
                        <option value="Laki-laki"
                            {{ old('gender', Auth::user()->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan"
                            {{ old('gender', Auth::user()->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- About Me -->
                <div class="col-span-2">
                    <label for="about_me" class="block text-sm font-medium text-gray-700">About Me</label>
                    <textarea name="about_me" id="about_me"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500"
                        rows="4">{{ old('about_me', Auth::user()->about_me) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 flex justify-end">
                    <button type="submit"
                        class="bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition duration-300">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
