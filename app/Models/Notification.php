<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'data',
        'is_read',
        'sent_at',
    ];

    public function scopeForUser($query, $userId)
{
    return $query->where(function ($q) use ($userId) {
        $q->where('user_id', $userId)      
          ->orWhereNull('user_id');      
    });
}

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}