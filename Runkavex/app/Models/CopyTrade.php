<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CopyTrade extends Model
{
    protected $fillable = [
        'user_id',
        'expert_id',
        'expert_name',
        'amount',
        'roi',
        'duration_days',
        'status',
        'started_at',
        'expires_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'roi' => 'decimal:2',
        'duration_days' => 'integer',
        'started_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}