<?php

namespace App\Http\Controllers\Back;

use App\Models\Project;
use App\Models\Category;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('back.dashboard.index', [
            'totalProjects' => Project::count(),
            'totalCategories' => Category::count(),
            'totalProgress' => Progress::count(),
            'totalViews' => Project::sum('views'),
            'recentProjects' => Project::latest()->take(5)->get(),
            'progressWeeks' => Progress::selectRaw('week')->groupBy('week')->pluck('week'),
            'progressCounts' => Progress::selectRaw('COUNT(*) as total')->groupBy('week')->pluck('total'),

        ]);
    }
}
