<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Formularz kontaktowy obsługiwany na stronie głównej
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
