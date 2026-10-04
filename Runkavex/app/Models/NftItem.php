<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NftItem extends Model
{
    protected $fillable = [
        'owner_id',
        'created_by',
        'collection_id',
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'properties',
        'views',
        'likes',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'properties' => 'array',
        'views' => 'integer',
        'likes' => 'integer',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(NftCollection::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NftCategory::class);
    }
}