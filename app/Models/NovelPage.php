<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NovelPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'episode_id',
        'page_number',
        'image_path',
        'file_path',
        'caption',
    ];

   
    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }
}
