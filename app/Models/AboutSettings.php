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
    
    // 3. Akcesory i mutatory
    public function getFormattedContentAttribute()
    {
        // Jeśli zawartość istnieje, przetwarzamy ją
        if ($this->content) {
            // RichEditor Filament używa HTML, więc już jest sformatowany
            // Nie potrzebujemy dodatkowego parsowania, ale zapewniamy czystość HTML
            return $this->content;
        }
        
        return '<p>Brak treści.</p>';
    }
    
    // 5. Metody pomocnicze - alfabetycznie
    public function getImageUrl()
    {
        if (!$this->image_path) {
            return null;
        }
        
        $path = 'storage/' . $this->image_path;
        
        // Sprawdzamy czy plik istnieje w publicznym storage
        if (file_exists(public_path($path))) {
            return asset($path);
        }
        
        // Jeśli plik nie istnieje, zwracamy domyślny obrazek
        return asset('images/default-profile.jpg');
    }
}
