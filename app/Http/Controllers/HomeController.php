<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSettings;

class HomeController extends Controller
{
    public function index()
    {
        $heroSettings = HeroSettings::first();
        return view('welcome', compact('heroSettings'));
    }
}
