<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'theme_preference', 'gmail_connected'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'theme_preference' => 'string',
        'gmail_connected' => 'boolean'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function updatePassword(string $newPassword): bool
    {
        $hashedPassword = Hash::make($newPassword);
        Log::info('Generated hashed password: ', ['hashed' => $hashedPassword]);

        $this->password = $hashedPassword;
        $result = $this->save();

        // Reload the model and log the password after saving
        $this->refresh();
        Log::info('Password retrieved from database: ', ['hashed' => $this->password]);

        // Verify using Hash::check
        if (Hash::check($newPassword, $this->password)) {
            Log::info('Password verification succeeded after update.');
        } else {
            Log::error('Password verification failed after update.');
            return false; // Return false if verification fails
        }

        Log::info('Password update operation completed.', ['success' => $result]);

        return $result;
    }
}
