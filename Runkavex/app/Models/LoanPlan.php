<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'min_amount',
        'max_amount',
        'interest_rate',
        'interest_type',
        'min_duration',
        'max_duration',
        'processing_fee',
        'min_account_balance',
        'requires_collateral',
        'collateral_percentage',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'min_amount' => 'float',
            'max_amount' => 'float',
            'interest_rate' => 'float',
            'min_duration' => 'integer',
            'max_duration' => 'integer',
            'processing_fee' => 'float',
            'min_account_balance' => 'float',
            'requires_collateral' => 'boolean',
            'collateral_percentage' => 'float',
            'is_active' => 'boolean',
        ];
    }
}