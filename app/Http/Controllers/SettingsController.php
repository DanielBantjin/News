<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function changePassword(Request $request)
    {
        Log::info('Password change request initiated.');

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!$user) {
            Log::error('No authenticated user found.');
            return response()->json([
                'status' => 'error',
                'message' => 'No authenticated user found.',
            ], 401);
        }

        Log::info('Authenticated user:', ['id' => $user->id, 'email' => $user->email]);

        if (!Hash::check($request->current_password, $user->password)) {
            Log::warning('Current password validation failed for user ID: ' . $user->id);
            return response()->json([
                'status' => 'error',
                'message' => 'The current password is incorrect.',
            ], 400);
        }

        if ($user->updatePassword($request->new_password)) {
            Log::info('Password successfully updated for user ID: ' . $user->id);
            return response()->json([
                'status' => 'success',
                'message' => 'Password updated successfully!',
            ]);
        } else {
            Log::error('Failed to update password for user ID: ' . $user->id);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update password.',
            ], 500);
        }
    }
}
