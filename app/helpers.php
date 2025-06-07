<?php

/**
 * Pomocnicza funkcja do uzyskiwania ustawień
 * 
 * @param string $key Klucz ustawienia
 * @param mixed $default Domyślna wartość, jeśli ustawienie nie istnieje
 * @return mixed
 */
function settings($key, $default = null)
{
    return config('settings.' . $key, $default);
}
