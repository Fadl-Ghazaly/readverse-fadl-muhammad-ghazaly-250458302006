<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'novel_id',
        'episode_id',
        'parent_id',
        'comment',
        'like_count',
        'unlike_count',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }
    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
                    ->orderBy('created_at', 'asc');
    }
    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }
}
