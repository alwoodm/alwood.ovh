<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Formularz kontaktowy obsługiwany na stronie głównej
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Trasy dla projektów - tylko API
Route::get('/projekty/dane/{slug}', [ProjectController::class, 'getProjectData'])->name('projects.data');
Route::get('/api/projects/load-more', [ProjectController::class, 'loadMoreProjects'])->name('projects.load-more');
