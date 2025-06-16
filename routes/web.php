<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Formularz kontaktowy obsługiwany na stronie głównej
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Trasy dla projektów
Route::get('/projekty', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projekty/dane/{slug}', [ProjectController::class, 'getProjectData'])->name('projects.data');
