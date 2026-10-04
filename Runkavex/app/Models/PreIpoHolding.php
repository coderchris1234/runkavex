<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreIpoHolding extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'company_name',
        'ticker',
        'shares',
        'price_per_share',
        'amount',
        'status',
    ];

    protected $casts = [
        'shares' => 'integer',
        'price_per_share' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}