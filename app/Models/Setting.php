<?php

// app/Models/Setting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme_preference',
        'language_preference',
        'email_notifications',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
