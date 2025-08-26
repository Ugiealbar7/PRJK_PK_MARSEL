<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project; // <-- tambahkan ini

class HomeController extends Controller
{
    public function index()
    {
        $latestProjects = Project::where('status', 1) // filter proyek terbaru
                            ->latest()
                            ->take(6)
                            ->get();

        return view('front.home', compact('latestProjects'));
    }
}
