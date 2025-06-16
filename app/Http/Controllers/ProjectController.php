<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Wyświetla listę projektów
     */
    public function index()
    {
        $projects = Project::orderBy('sort_order', 'asc')->get();
        
        return view('projects.index', [
            'projects' => $projects,
            'title' => 'Projekty',
            'subtitle' => 'Lista zrealizowanych projektów'
        ]);
    }
    
    /**
     * Pobiera dane projektu w formacie JSON dla modalnego okna
     */
    public function getProjectData($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        
        return response()->json([
            'title' => $project->title,
            'description' => $project->full_description,
            'technologies' => $project->technologies,
            'demoUrl' => $project->demo_url,
            'codeUrl' => $project->code_url,
            'thumbnailUrl' => $project->thumbnail_url,
        ]);
    }
}
