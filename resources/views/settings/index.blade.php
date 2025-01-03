@extends('layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold mb-4">Pengaturan Aplikasi</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST">
        @csrf

        <!-- Tema -->
        <div class="mb-6">
            <label for="theme_preference" class="block text-sm font-medium text-gray-700">Tema</label>
            <select name="theme_preference" id="theme_preference" class="mt-2 block w-full px-4 py-2 border rounded-md">
                <option value="light" {{ $settings->theme_preference == 'light' ? 'selected' : '' }}>Terang</option>
                <option value="dark" {{ $settings->theme_preference == 'dark' ? 'selected' : '' }}>Gelap</option>
            </select>
        </div>

        <!-- Preferensi Bahasa -->
        <div class="mb-6">
            <label for="language_preference" class="block text-sm font-medium text-gray-700">Preferensi Bahasa</label>
            <select name="language_preference" id="language_preference" class="mt-2 block w-full px-4 py-2 border rounded-md">
                <option value="en" {{ $settings->language_preference == 'en' ? 'selected' : '' }}>English</option>
                <option value="id" {{ $settings->language_preference == 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
            </select>
        </div>

        <!-- Notifikasi Email -->
        <div class="mb-6">
            <label for="email_notifications" class="inline-flex items-center text-sm font-medium text-gray-700">
                <input type="checkbox" name="email_notifications" id="email_notifications" class="form-checkbox" {{ $settings->email_notifications ? 'checked' : '' }}>
                <span class="ml-2">Terima notifikasi email</span>
            </label>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md">Simpan Pengaturan</button>
    </form>
</div>
@endsection
