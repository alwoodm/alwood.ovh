<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    // Nie potrzebujemy już metody index() ponieważ formularz kontaktowy 
    // jest częścią głównego widoku
    
    /**
     * Przetwarza przesłany formularz kontaktowy
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required',
        ]);
        
        Message::create($validated);
        
        return redirect('/')
            ->with('success', 'Wiadomość została wysłana. Dziękujemy za kontakt!');
    }
}
