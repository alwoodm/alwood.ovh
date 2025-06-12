<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSettings extends Model
{
    // 1. Użycie traitów
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    
    // 2. Właściwości (properties)
    protected $fillable = [
        'content',
        'show_image',
        'image_path',
        'image_position',
        'section_title',
    ];
    
    protected $casts = [
        'show_image' => 'boolean',
    ];
    
    // 5. Metody pomocnicze - alfabetycznie
    public function getImageUrl()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }
}
