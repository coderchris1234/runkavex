<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseLesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'category',
        'description',
        'duration_seconds',
        'video_url',
        'is_preview',
    ];

    protected $casts = [
        'duration_seconds' => 'integer',
        'is_preview' => 'boolean',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}