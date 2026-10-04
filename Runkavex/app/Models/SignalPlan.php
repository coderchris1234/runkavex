<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'price',
        'duration',
        'benefits',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'float',
            'is_active' => 'boolean',
        ];
    }

    public function benefitsList(): array
    {
        $decoded = json_decode((string) $this->benefits, true);

        return is_array($decoded) && ! empty($decoded) ? $decoded : [];
    }
}