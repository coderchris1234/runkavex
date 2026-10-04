<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trading_asset_id',
        'symbol',
        'name',
        'asset_class',
        'trade_type',
        'action',
        'amount',
        'leverage',
        'entry_price',
        'duration',
        'expires_at',
        'status',
        'result',
        'pnl',
        'is_demo',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'float',
            'entry_price' => 'float',
            'pnl' => 'float',
            'is_demo' => 'boolean',
            'expires_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}