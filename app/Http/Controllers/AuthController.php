<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'username' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:8|confirmed',
        'birthplace' => 'required|string|max:255',
        'birthdate' => 'required|date',
        'gender' => 'required|string|in:Laki-laki,Perempuan',
    ]);

    // Membuat user baru tanpa hashing password secara manual
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'username' => $request->username,
        'password' => $request->password, 
        'birthplace' => $request->birthplace,
        'birthdate' => $request->birthdate,
        'gender' => $request->gender,
    ]);

    // Login otomatis setelah registrasi
    Auth::login($user);

    return redirect()->route('home')->with('success', 'Registrasi berhasil!');
}
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Login berhasil!'); // Mengarahkan ke beranda
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
