<?php

namespace App\Models;

use App\Models\Novel;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Bookmark;
use App\Models\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'notifications_enabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function comments()
{
    return $this->hasMany(Comment::class);
}

public function bookmarks()
{
    return $this->hasMany(Bookmark::class);
}

public function bookmarkedNovels()
{
    return $this->belongsToMany(Novel::class, 'bookmarks')->withTimestamps();
}

public function notifications()
{
    return $this->hasMany(Notification::class);
}

// Mengambil notifikasi aktif
public function activeNotifications()
{
    return $this->notifications()->where('is_enabled', true);
}

// Menonaktifkan semua notifikasi user
public function disableNotifications()
{
    return $this->notifications()->update(['is_enabled' => false]);
}

public function reports()
{
    return $this->hasMany(Report::class);
}


}
