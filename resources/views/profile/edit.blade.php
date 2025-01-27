@extends('layouts.app')

@section('title', 'Edit Profil Saya')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-20" style="background-color: var(--background-primary);">
        <div class="w-full max-w-4xl rounded-lg shadow-lg p-8"
            style="background-color: var(--background-secondary); color: var(--text-primary);">
            <h2 class="text-2xl font-bold text-center mb-6" style="color: var(--text-primary);">Edit Profil Saya</h2>

            <!-- Form Edit Profile -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input Foto Profil -->
                <div class="col-span-2 flex items-center gap-4 mb-4 relative">
                    <div class="relative">
                        <img src="{{ Auth::user()->profile_picture_url ?? asset('images/default-profile.png') }}"
                            alt="Foto Profil" class="w-20 h-20 rounded-full border-2 border-[var(--text-primary)]">
                        <!-- Ikon Kamera -->
                        <label for="profile_picture"
                            class="absolute bottom-0 right-0 bg-[var(--button-primary)] text-[var(--button-text)] p-2 rounded-full cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232a3 3 0 00-4.242 0l-5.5 5.5a3 3 0 000 4.242l3.5 3.5a3 3 0 004.242 0l5.5-5.5a3 3 0 000-4.242l-3.5-3.5z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 8l-8 8" />
                            </svg>
                        </label>
                    </div>
                    <div>
                        <input type="file" name="profile_picture" id="profile_picture" class="hidden" onchange="showFileName()">
                        <span id="file-name" class="block text-sm text-[var(--text-secondary)] mt-2">Tidak ada file yang dipilih</span>
                    </div>
                </div>

                <!-- Input Fields -->
                @php
                    $fields = [
                        'name' => 'Full Name',
                        'username' => 'User Name',
                        'email' => 'Email',
                        'contact' => 'Contact',
                        'birthplace' => 'Birthplace',
                    ];
                @endphp

                @foreach ($fields as $field => $label)
                    <div class="col-span-2 mb-4">
                        <label for="{{ $field }}" class="block text-sm font-medium mb-2"
                            style="color: var(--text-secondary);">
                            {{ $label }}
                        </label>
                        <input type="{{ $field === 'email' ? 'email' : 'text' }}" name="{{ $field }}"
                            id="{{ $field }}" value="{{ old($field, Auth::user()->$field) }}"
                            class="block w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                            style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);"
                            {{ in_array($field, ['name', 'username', 'email']) ? 'required' : '' }}>
                    </div>
                @endforeach

                <!-- Birthdate -->
                <div class="col-span-2 mb-4">
                    <label for="birthdate" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">Birthdate</label>
                    <input type="date" name="birthdate" id="birthdate"
                        value="{{ old('birthdate', Auth::user()->birthdate ? Auth::user()->birthdate->format('Y-m-d') : '') }}"
                        class="block w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                        style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">
                </div>

                <!-- Gender -->
                <div class="col-span-2 mb-4">
                    <label for="gender" class="block text-sm font-medium mb-2"
                        style="color: var(--text-secondary);">Gender</label>
                    <select name="gender" id="gender"
                        class="block w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                        style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">
                        <option value="">Select Gender</option>
                        <option value="Laki-laki"
                            {{ old('gender', Auth::user()->gender) == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan"
                            {{ old('gender', Auth::user()->gender) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <!-- About Me -->
                <div class="col-span-2 mb-6">
                    <label for="about_me" class="block text-sm font-medium mb-2"
                        style="color: var(--text-secondary);">About
                        Me</label>
                    <textarea name="about_me" id="about_me" rows="4"
                        class="block w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                        style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">{{ old('about_me', Auth::user()->about_me) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 flex justify-end">
                    <button type="submit" class="py-2 px-4 rounded-lg hover:shadow-md transition duration-300"
                        style="background-color: var(--button-primary); color: var(--button-text);">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function showFileName() {
            const input = document.getElementById('profile_picture');
            const fileName = document.getElementById('file-name');
            fileName.textContent = input.files[0] ? input.files[0].name : 'Tidak ada file yang dipilih';
        }
    </script>
@endsection
