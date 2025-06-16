<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    // 1. Użycie traitów
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    
    // 2. Właściwości (properties)
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'thumbnail_path',
        'technologies',
        'demo_url',
        'code_url',
        'is_featured',
        'sort_order',
        'show_thumbnail',
    ];
    
    protected $casts = [
        'is_featured' => 'boolean',
        'show_thumbnail' => 'boolean',
        'technologies' => 'array',
    ];
    
    protected $appends = [
        'thumbnail_url',
    ];
    
    // Ustaw slug przed zapisem
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
        
        static::updating(function ($project) {
            if ($project->isDirty('title') && !$project->isDirty('slug')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
    
    // 3. Akcesory i mutatory
    public function getFormattedFullDescriptionAttribute()
    {
        if ($this->full_description) {
            return $this->full_description;
        }
        
        return '<p>Brak szczegółowego opisu projektu.</p>';
    }
    
    // Accessor dla thumbnail_url
    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail_path) {
            return asset('images/default-project.jpg');
        }
        
        $path = 'storage/' . $this->thumbnail_path;
        
        // Sprawdzamy czy plik istnieje w publicznym storage
        if (file_exists(public_path($path))) {
            return asset($path);
        }
        
        // Jeśli plik nie istnieje, zwracamy domyślny obrazek
        return asset('images/default-project.jpg');
    }
    
    // 5. Metody pomocnicze - alfabetycznie
    public function hasDemoUrl()
    {
        return !empty($this->demo_url);
    }
    
    public function hasCodeUrl()
    {
        return !empty($this->code_url);
    }
    
    // 6. Scope'y
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
