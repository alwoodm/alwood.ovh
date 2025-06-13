<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSettings extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'site_title',
        'site_description',
        'site_keywords',
        'favicon_path',
        'og_image_path',
        'twitter_image_path',
        'google_analytics_id',
        'use_site_name_in_title',
        'title_separator',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'use_site_name_in_title' => 'boolean',
    ];
    
    /**
     * Pobierz instancję ustawień SEO - zawsze zwraca jedną instancję
     *
     * @return self
     */
    public static function getInstance(): self
    {
        return self::firstOrCreate(['id' => 1]);
    }
    
    /**
     * Zwraca pełną ścieżkę do pliku favicon
     *
     * @return string|null
     */
    public function getFaviconUrl(): ?string
    {
        if (!$this->favicon_path) {
            return asset('favicon.ico');
        }
        
        return asset('storage/' . $this->favicon_path);
    }
    
    /**
     * Zwraca pełną ścieżkę do obrazu Open Graph
     *
     * @return string|null
     */
    public function getOgImageUrl(): ?string
    {
        if (!$this->og_image_path) {
            return null;
        }
        
        return asset('storage/' . $this->og_image_path);
    }
    
    /**
     * Zwraca pełną ścieżkę do obrazu Twitter
     *
     * @return string|null
     */
    public function getTwitterImageUrl(): ?string
    {
        if (!$this->twitter_image_path) {
            return null;
        }
        
        return asset('storage/' . $this->twitter_image_path);
    }
    
    /**
     * Generuje tytuł strony uwzględniając ustawienia
     *
     * @param string|null $pageTitle Tytuł podstrony
     * @return string
     */
    public function generateTitle(?string $pageTitle = null): string
    {
        if (empty($pageTitle)) {
            return $this->site_title;
        }
        
        if ($this->use_site_name_in_title) {
            return $pageTitle . $this->title_separator . $this->site_title;
        }
        
        return $pageTitle;
    }
}
