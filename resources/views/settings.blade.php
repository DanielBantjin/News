@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 max-w-lg" 
     style="background-color: var(--background-primary); color: var(--text-primary); border-radius: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-top: 5rem;">
    <h2 class="text-4xl font-extrabold mb-6 border-b-4 pb-3" 
        style="border-color: var(--text-link);">⚙️ Pengaturan</h2>

    <h3 class="text-2xl font-semibold mb-6" 
        style="color: var(--text-secondary);">🔒 Ubah Password</h3>

    @if (session('success'))
        <div style="background-color: var(--background-secondary); color: var(--text-primary); padding: 1rem; margin-bottom: 1.5rem; border-radius: 0.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background-color: var(--background-secondary); color: var(--text-primary); padding: 1rem; margin-bottom: 1.5rem; border-radius: 0.5rem;">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('settings.changePassword') }}" method="POST" class="space-y-8">
        @csrf
        <div>
            <label for="current_password" 
                   style="color: var(--text-secondary);" 
                   class="block text-sm font-medium mb-2">🔑 Password</label>
            <input type="password" id="current_password" name="current_password" 
                   style="background-color: var(--background-secondary); color: var(--text-primary); border: 1px solid var(--text-secondary);" 
                   class="w-full px-4 py-2 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label for="new_password" 
                   style="color: var(--text-secondary);" 
                   class="block text-sm font-medium mb-2">🔑 Password Baru</label>
            <input type="password" id="new_password" name="new_password" 
                   style="background-color: var(--background-secondary); color: var(--text-primary); border: 1px solid var(--text-secondary);" 
                   class="w-full px-4 py-2 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label for="new_password_confirmation" 
                   style="color: var(--text-secondary);" 
                   class="block text-sm font-medium mb-2">🔑 Konfirmasi Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                   style="background-color: var(--background-secondary); color: var(--text-primary); border: 1px solid var(--text-secondary);" 
                   class="w-full px-4 py-2 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <button type="submit" 
                style="background-color: var(--button-primary); color: var(--button-text);" 
                class="w-full py-3 rounded-lg shadow-lg hover:bg-[var(--button-hover)]">
            🚀 Ubah Password
        </button>
    </form>
</div>
@endsection
