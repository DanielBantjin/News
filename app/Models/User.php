<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'theme',  // Preferensi tema
        'notifications_enabled', // Preferensi notifikasi
        'language_preference'    // Preferensi bahasa
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'notifications_enabled' => 'boolean',
        'is_profile_private' => 'boolean',
        'theme' => 'string', // Menjamin bahwa tema preference adalah string
        'language_preference' => 'string', // Menjamin bahwa bahasa preference adalah string
    ];
}
