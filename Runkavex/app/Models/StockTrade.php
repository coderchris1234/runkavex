<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockTrade extends Model
{
    protected $fillable = [
        'user_id',
        'stock_id',
        'symbol',
        'company_name',
        'type',
        'shares',
        'price',
        'amount',
        'status',
    ];

    protected $casts = [
        'shares' => 'decimal:6',
        'price' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}