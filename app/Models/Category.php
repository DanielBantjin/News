<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Properti yang dapat diisi melalui mass assignment.
     */
    protected $fillable = ['name'];

    /**
     * Relasi ke model Article.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Relasi ke model Blog.
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
