<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author',
        'image',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk artikel yang dipublikasi
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk artikel draft
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
