@extends('layouts.app')

@section('title', __('Settings'))

@section('content')
<div class="container mx-auto px-4 py-20">
    <h1 class="text-4xl font-bold mb-8 text-white">{{ __('Settings') }}</h1>

    @if(session('success'))
        <div class="mb-4 text-green-500">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Theme Preference -->
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Theme Preference') }}</h2>
            <form action="{{ route('settings.updateTheme') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <label class="block text-sm">{{ __('Select Theme') }}</label>
                    <select name="theme_preference" class="w-full p-2 rounded-lg bg-gray-700 text-white border-none">
                        <option value="light" {{ $themePreference === 'light' ? 'selected' : '' }}>{{ __('Light Mode') }}</option>
                        <option value="dark" {{ $themePreference === 'dark' ? 'selected' : '' }}>{{ __('Dark Mode') }}</option>
                    </select>
                </div>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    {{ __('Save Preference') }}
                </button>
            </form>
        </div>

        <!-- Language Setting -->
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Language Setting') }}</h2>
            <form action="{{ route('settings.updateLanguage') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <label class="block text-sm">{{ __('Select Language') }}</label>
                    <select name="language" class="w-full p-2 rounded-lg bg-gray-700 text-white border-none">
                        <option value="id" {{ $languagePreference === 'id' ? 'selected' : '' }}>ID</option>
                        <option value="en" {{ $languagePreference === 'en' ? 'selected' : '' }}>EN</option>
                    </select>
                </div>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    {{ __('Save Language') }}
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Change Password') }}</h2>
            <form action="{{ route('settings.updatePassword') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm">{{ __('Current Password') }}</label>
                        <input type="password" name="current_password" class="w-full p-2 rounded-lg bg-gray-700 border-none">
                    </div>
                    <div>
                        <label class="block text-sm">{{ __('New Password') }}</label>
                        <input type="password" name="new_password" class="w-full p-2 rounded-lg bg-gray-700 border-none">
                    </div>
                    <div>
                        <label class="block text-sm">{{ __('Confirm New Password') }}</label>
                        <input type="password" name="new_password_confirmation" class="w-full p-2 rounded-lg bg-gray-700 border-none">
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    {{ __('Change Password') }}
                </button>
            </form>
        </div>

        <!-- Notifications Preference -->
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Notification Preferences') }}</h2>
            <form action="{{ route('settings.updateNotifications') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <label class="block text-sm">{{ __('Select Notification Preference') }}</label>
                    <select name="notifications_enabled" class="w-full p-2 rounded-lg bg-gray-700 text-white border-none">
                        <option value="1" {{ $notificationsEnabled ? 'selected' : '' }}>{{ __('Enable Notifications') }}</option>
                        <option value="0" {{ !$notificationsEnabled ? 'selected' : '' }}>{{ __('Disable Notifications') }}</option>
                    </select>
                </div>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                    {{ __('Save Notification Preference') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
