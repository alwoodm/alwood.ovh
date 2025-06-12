<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSettings;
use App\Models\AboutSettings;

class HomeController extends Controller
{
    public function index()
    {
        $heroSettings = HeroSettings::first();
        $aboutSettings = AboutSettings::first();
        
        return view('welcome', compact('heroSettings', 'aboutSettings'));
    }
}
