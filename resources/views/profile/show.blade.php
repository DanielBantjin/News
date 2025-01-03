@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-black to-gray-900">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <img src="{{ Auth::user()->profile_picture_url ? asset(Auth::user()->profile_picture_url) : asset('images/default-profile.png') }}" alt="Foto Profil" class="w-20 h-20 rounded-full">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600">Member</p>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="bg-gray-200 text-gray-700 py-1 px-3 rounded-lg hover:bg-gray-300 transition duration-300">Edit User</a>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <p class="mt-1 text-gray-800">{{ Auth::user()->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">User Name</label>
                <p class="mt-1 text-gray-800">{{ Auth::user()->username }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-gray-800">{{ Auth::user()->email }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Contact</label>
                <p class="mt-1 text-gray-800">{{ Auth::user()->contact }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Birthplace</label>
                <p class="mt-1 text-gray-800">{{ Auth::user()->birthplace }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Birthdate</label>
                <p class="mt-1 text-gray-800">{{ Auth::user()->birthdate }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <p class="mt-1 text-gray-800">{{ Auth::user()->gender }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">About Me</label>
                <p class="mt-1 text-gray-800">{{ Auth::user()->about_me }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
