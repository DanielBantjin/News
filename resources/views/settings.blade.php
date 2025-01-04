@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 max-w-lg bg-gradient-to-r from-gray-50 to-gray-100 shadow-2xl rounded-lg mt-20">
    <h2 class="text-4xl font-extrabold text-gray-800 mb-6 border-b-4 border-blue-600 pb-3">⚙️ Settings</h2>

    <h3 class="text-2xl font-semibold text-blue-500 mb-6">🔒 Change Password</h3>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-6 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-6 rounded-lg shadow-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settings.changePassword') }}" method="POST" class="space-y-8">
        @csrf
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">🔑 Current Password</label>
            <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">🔑 New Password</label>
            <input type="password" id="new_password" name="new_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">🔑 Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-500">
            🚀 Change Password
        </button>
    </form>
</div>
@endsection
