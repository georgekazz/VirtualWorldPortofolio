<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'thumbnail',
        'screenshots',
        'links',
        'education_level',
        'class_level',
        'year',
        'project_type'
    ];

    // Για να μετατρέπεις το screenshots από JSON σε array αυτόματα:
    protected $casts = [
        'screenshots' => 'array',
        'links' => 'array',
    ];

}
