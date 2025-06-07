<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'description',
    ];

    /**
     * Pobiera wartość ustawienia na podstawie klucza
     * 
     * @param string $key Klucz ustawienia
     * @param mixed $default Domyślna wartość, jeśli ustawienie nie istnieje
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Aktualizuje lub tworzy ustawienie
     * 
     * @param string $key Klucz ustawienia
     * @param mixed $value Wartość ustawienia
     * @param string $group Grupa ustawienia
     * @param string|null $description Opis ustawienia
     * @return Settings
     */
    public static function set(string $key, $value, string $group = 'general', ?string $description = null)
    {
        $setting = self::firstOrNew(['key' => $key]);
        $setting->value = $value;
        $setting->group = $group;
        
        if ($description) {
            $setting->description = $description;
        }
        
        $setting->save();
        
        return $setting;
    }
}
