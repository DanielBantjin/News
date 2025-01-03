<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'image',
        'author_id',
        'status', 
        'published_at',
    ];
    

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getFormattedPublishedAtAttribute()
{
    return $this->published_at ? $this->published_at->format('d F Y') : 'Belum Dipublikasikan';
}

}
