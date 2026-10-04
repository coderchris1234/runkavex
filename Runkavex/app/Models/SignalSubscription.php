<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'signal_plan_id',
        'plan_name',
        'price',
        'duration',
        'status',
        'started_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'float',
            'started_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(SignalPlan::class, 'signal_plan_id');
    }
}