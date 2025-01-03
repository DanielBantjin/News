<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $table = 'news_articles';

    protected $fillable = [
        'title', 'slug', 'content', 'image', 'author_id', 'category_id', 'status', 'published_at'
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_article_tag', 'news_article_id', 'tag_id');
    }

    // Scope untuk artikel yang dipublikasikan
    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at');
    }

    // Mendapatkan tanggal dipublikasikan dalam format tertentu (fallback jika null)
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('d F Y') : 'Tanggal tidak tersedia';
    }

    // Mendapatkan tanggal dibuat dalam format tertentu (fallback jika null)
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at ? $this->created_at->format('d F Y') : 'Tanggal tidak tersedia';
    }

    // Mencari artikel berdasarkan slug
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}
