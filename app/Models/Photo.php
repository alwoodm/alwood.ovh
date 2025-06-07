<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'path',
        'alt_text',
        'category',
        'is_featured',
        'sort_order'
    ];
    
    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer'
    ];
}
