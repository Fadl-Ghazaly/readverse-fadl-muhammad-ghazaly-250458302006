<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Bookmark;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'title',
        'slug',
        'description',
        'cover_image',
        'author',
        'status'
    ];

    protected static function boot()
{
    parent::boot();

    static::creating(function ($novel) {
        if (!$novel->slug) {
            $novel->slug = Str::slug($novel->title);
        }
    });

    static::updating(function ($novel) {
        if ($novel->isDirty('title')) {
            $novel->slug = \Illuminate\Support\Str::slug($novel->title);
        }
    });
}


    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function episodes()
{
    return $this->hasMany(Episode::class);
}

public function genres()
{
    return $this->belongsToMany(Genre::class, 'novel_genre', 'novel_id', 'genre_id');
}

public function bookmarks()
{
    return $this->hasMany(Bookmark::class);
}

public function bookmarkedBy()
{
    return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
}

public function reports()
{
    return $this->hasMany(Report::class);
}

public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function likes()
{
    return $this->morphMany(Like::class, 'likeable');
}




}
