<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('alert', 'No authenticated user found.');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('alert', 'The current password is incorrect.');
        }

        if ($user->updatePassword($request->new_password)) {
            return redirect()->back()->with('alert', 'Password updated successfully!');
        } else {
            return redirect()->back()->with('alert', 'Failed to update password.');
        }
    }
}
