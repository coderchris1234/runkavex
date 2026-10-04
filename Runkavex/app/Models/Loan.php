<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'reference',
        'plan_name',
        'amount',
        'duration',
        'interest_rate',
        'interest_type',
        'processing_fee',
        'total_interest',
        'processing_fee_amount',
        'total_repayable',
        'monthly_payment',
        'purpose',
        'status',
        'start_date',
        'end_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}