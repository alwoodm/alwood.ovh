<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Wyświetla listę projektów (wszystkie na jednej stronie)
     */
    public function index()
    {
        // Pobierz wszystkie projekty posortowane według kategorii i kolejności
        $featuredProjects = Project::where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $otherProjects = Project::where('is_featured', false)
            ->orderBy('sort_order', 'asc')
            ->get();
        
        return view('projects.index', [
            'featuredProjects' => $featuredProjects,
            'otherProjects' => $otherProjects,
            'title' => 'Moje projekty',
            'subtitle' => 'Moje projekty oraz te nad którymi pracowałem w ramach praktyk, zleceń, pracy zespołowej itd.'
        ]);
    }
    
    /**
     * API endpoint do ładowania dodatkowych projektów
     */
    public function loadMoreProjects()
    {
        $otherProjects = Project::where('is_featured', false)
            ->orderBy('sort_order', 'asc')
            ->get();

        $html = '';
        foreach ($otherProjects as $project) {
            $html .= view('components.projects.card', ['project' => $project])->render();
        }

        return response()->json([
            'html' => $html,
            'hasMore' => false // Już ładujemy wszystkie
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
            'category' => $project->category,
        ]);
    }
}
