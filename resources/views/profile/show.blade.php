@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20" style="background-color: var(--background-primary);">
    <div class="w-full max-w-4xl rounded-lg shadow-lg p-8" style="background-color: var(--background-secondary); color: var(--text-primary);">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <img src="{{ Auth::user()->profile_picture_url ? asset(Auth::user()->profile_picture_url) : asset('images/default-profile.png') }}" 
                     alt="Foto Profil" 
                     class="w-20 h-20 rounded-full border-2 border-[var(--text-primary)]">
                <div>
                    <h2 class="text-2xl font-bold" style="color: var(--text-primary);">{{ Auth::user()->name }}</h2>
                    <p class="text-sm" style="color: var(--text-secondary);">Member</p>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" 
               class="py-1 px-3 rounded-lg transition duration-300" 
               style="background-color: var(--button-primary); color: var(--button-text);">
                Edit Profil
            </a>
        </div>

        <div class="grid grid-cols-2 gap-6">
            @php
                $fields = [
                    'name' => 'Full Name',
                    'username' => 'User Name',
                    'email' => 'Email',
                    'contact' => 'Contact',
                    'birthplace' => 'Birthplace',
                    'birthdate' => 'Birthdate',
                    'gender' => 'Gender',
                ];
            @endphp

            @foreach ($fields as $field => $label)
                <div>
                    <label class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">
                        {{ $label }}
                    </label>
                    <p style="color: var(--text-primary);">{{ Auth::user()->$field }}</p>
                </div>
            @endforeach

            <div class="col-span-2">
                <label class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">About Me</label>
                <p style="color: var(--text-primary);">{{ Auth::user()->about_me }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
