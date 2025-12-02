<?php

namespace App\Models;

use App\Models\Novel;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'target_type',
        'target_id',
        'kategori',
        'deskripsi',
        'status',
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

      public function target()
    {
        return $this->morphTo(null, 'target_type', 'target_id');
    }

    public function getTargetTypeNameAttribute()
{
    return match ($this->target_type) {
        Novel::class => 'Novel',
        Episode::class => 'Episode',
        default => 'Tidak Diketahui',
    };
}

public function getTargetTitleAttribute()
{
    if (!$this->target) {
        return 'Tidak ditemukan';
    }

    return match ($this->target_type) {
        \App\Models\Novel::class => $this->target->title,
        \App\Models\Episode::class => $this->target->judul,
        default => 'Tidak diketahui'
    };
}


}
