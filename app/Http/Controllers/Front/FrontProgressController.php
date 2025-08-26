<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use Illuminate\View\View; // <-- tambahkan ini

class FrontProgressController extends Controller
{
    public function weekly(): View
    {
        $progressList = Progress::with(['project:id,title,slug'])
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('front.progress.weekly', compact('progressList'));
    }

    public function show($id): View
    {
        $progress = Progress::with('project')->findOrFail($id);
        return view('front.progress.show', compact('progress'));
    }
}
