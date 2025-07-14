<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalProjects = \App\Models\Project::where('status', 0)->count();
        $totalProgress = \App\Models\Progress::count();

        return view('front.home', compact('totalProjects', 'totalProgress'));
    }
}
