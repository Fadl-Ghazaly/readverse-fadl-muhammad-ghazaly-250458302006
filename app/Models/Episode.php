<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'novel_id',
        'judul',
        'deskripsi',
        'episode_number',
        'cover_image',
        'file_path',
        'status',
    ];

  
    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }

    public function pages()
{
    return $this->hasMany(NovelPage::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function reports()
{
    return $this->hasMany(Report::class);
}

public function likes()
{
    return $this->morphMany(Like::class, 'likeable');
}


}
