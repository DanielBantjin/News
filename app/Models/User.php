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
        'name',
        'email',
        'username',
        'password',
        'theme_preference',
        'gmail_connected',
        'birthplace',
        'birthdate',
        'gender',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mutator for automatically hashing passwords when set.
     */
    public function setPasswordAttribute($value)
    {
        // Menggunakan Hash::make untuk meng-hash password jika password diberikan
        $this->attributes['password'] = Hash::make($value);
    }


    /**
     * Update the user's password and verify it after saving.
     *
     * @param string $newPassword
     * @return bool
     */
    public function updatePassword(string $newPassword): bool
    {
        $this->password = $newPassword; // Mutator will handle hashing
        $result = $this->save();

        $this->refresh();
        Log::info('Password retrieved from database after save:', ['hashed' => $this->password]);

        if (Hash::check($newPassword, $this->password)) {
            Log::info('Password verification succeeded after update.');
            return $result;
        } else {
            Log::error('Password verification failed after update.', [
                'input_password' => $newPassword,
                'hashed_password_in_db' => $this->password,
            ]);
            return false;
        }
    }
}
