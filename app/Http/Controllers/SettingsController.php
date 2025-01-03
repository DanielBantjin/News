<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    // Menampilkan halaman pengaturan
    public function index()
    {
        $user = Auth::user();
        
        // Memastikan data yang diteruskan ke view adalah tipe yang benar
        $themePreference = is_string($user->theme_preference) ? $user->theme_preference : 'light';
        $languagePreference = is_string(Session::get('locale')) ? Session::get('locale') : config('app.locale');
        $notificationsEnabled = is_bool($user->notifications_enabled) ? $user->notifications_enabled : true;  // Default true

        return view('settings', [
            'themePreference' => $themePreference,
            'languagePreference' => $languagePreference,
            'notificationsEnabled' => $notificationsEnabled,
        ]);
    }

    // Mengupdate preferensi tema
    public function updateThemePreference(Request $request)
    {
        $request->validate([
            'theme_preference' => 'required|in:light,dark',
        ]);

        $user = Auth::user();
        $user->update(['theme_preference' => $request->theme_preference]);

        return redirect()->route('settings')->with('success', __('Theme preference updated.'));
    }

    // Mengupdate preferensi bahasa
    public function updateLanguagePreference(Request $request)
    {
        $request->validate([
            'language' => 'required|in:id,en',
        ]);

        $language = $request->input('language');
        Session::put('locale', $language);

        return redirect()->route('settings')->with('success', __('Language preference updated.'));
    }

    // Mengubah password pengguna
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => __('Current password is incorrect.')]);
        }

        $user->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('settings')->with('success', __('Password updated successfully.'));
    }

    // Mengubah preferensi notifikasi
    public function updateNotifications(Request $request)
    {
        $request->validate([
            'notifications_enabled' => 'required|boolean',
        ]);

        $user = Auth::user();
        $user->update(['notifications_enabled' => $request->notifications_enabled]);

        return redirect()->route('settings')->with('success', __('Notification preference updated.'));
    }
}
