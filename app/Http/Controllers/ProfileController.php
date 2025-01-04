<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', ['user' => $user]);
    }

    /**
     * Show the form to edit the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'contact' => 'nullable|string|max:15',
        'about_me' => 'nullable|string',
        'birthplace' => 'nullable|string|max:255',
        'birthdate' => 'nullable|date',
        'gender' => 'nullable|in:Laki-laki,Perempuan',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file
    ]);

    $user = Auth::user();

    if ($request->hasFile('profile_picture')) {

        if ($user->profile_picture_url && file_exists(public_path($user->profile_picture_url))) {
            unlink(public_path($user->profile_picture_url));
        }


        $file = $request->file('profile_picture');
        $filePath = 'uploads/profile_pictures/';
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($filePath), $fileName);


        $user->profile_picture_url = $filePath . $fileName;
    }

    $user->update([
        'name' => $request->input('name'),
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'contact' => $request->input('contact'),
        'about_me' => $request->input('about_me'),
        'birthplace' => $request->input('birthplace'),
        'birthdate' => $request->input('birthdate'),
        'gender' => $request->input('gender'),
    ]);

    return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
}

}
