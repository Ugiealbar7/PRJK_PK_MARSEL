<?php

namespace App\Http\Controllers\Front;



use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\View;

class PublicProjectController extends Controller
{
    // Project Terbaru (status = 1)
    public function index(): View
    {
        $projects = Project::with('category')
            ->where('status', 1)
            ->orderByDesc('publish_date')
            ->paginate(6);

        return view('front.project.index', compact('projects'));
    }

    // Project Mingguan (misal status = 2)
   // app/Http/Controllers/Front/PublicProjectController.php
// app/Http/Controllers/Front/PublicProjectController.php
public function weekly(): \Illuminate\Contracts\View\View
{
    $progressList = \App\Models\Progress::with(['project:id,title,slug'])
        ->orderByDesc('created_at')
        ->paginate(9);

    return view('front.progress.weekly', compact('progressList')); // ganti view & variabel
}




    // Arsip Project (misal status = 3)
    public function archive(): View
    {
        $projects = Project::with('category')
            ->where('status', 3)  // contoh: status 3 = arsip
            ->orderByDesc('publish_date')
            ->paginate(6);

        return view('front.project.archive', compact('projects'));
    }

    // Detail project
   public function show(string $slug): View
{
    $project = Project::with(['category', 'progresses' => function ($query) {
        $query->orderByDesc('created_at');
    }])
    ->where('slug', $slug)
    ->where('status', '!=', 0)
    ->firstOrFail();

    $project->increment('views');

    $progresses = $project->progresses;

    return view('front.project.show', compact('project', 'progresses'));
}
}
