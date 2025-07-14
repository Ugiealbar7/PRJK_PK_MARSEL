<?php

namespace App\Http\Controllers\Front;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 0)->latest()->paginate(6);
        return view('front.projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->where('status', 0)->firstOrFail();
        $project->increment('views'); // Tambah views
        $progresses = $project->progresses()->latest()->get();

        return view('front.projects.show', compact('project', 'progresses'));
    }
}
