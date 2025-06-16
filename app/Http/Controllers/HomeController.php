<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSettings;
use App\Models\AboutSettings;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $heroSettings = HeroSettings::first();
        $aboutSettings = AboutSettings::first();
        $featuredProjects = Project::where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->take(3)
            ->get();
        
        return view('welcome', compact('heroSettings', 'aboutSettings', 'featuredProjects'));
    }
}
