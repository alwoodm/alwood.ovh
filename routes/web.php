<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Formularz kontaktowy obsługiwany na stronie głównej
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
