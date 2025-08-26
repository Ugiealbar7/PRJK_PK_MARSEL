<?php

namespace App\Http\Controllers\Back;

use App\Models\Project;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
    public function index(Project $project)
    {
        return view('back.progress.index', compact('project'));
    }

    public function create(Project $project)
    {
        return view('back.progress.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'week'        => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'video'       => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/mov|max:50000', // 50MB
        ]);

        $progress = new Progress();
        $progress->project_id  = $project->id;
        $progress->title       = $request->title;
        $progress->week        = $request->week;
        $progress->description = $request->description;

        if ($request->hasFile('video')) {
            $file     = $request->file('video');
            $fileName = uniqid('vid_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/videos', $fileName);
            $progress->video_path = $fileName;
        }

        $progress->save();

        return redirect()->route('progress.index', $project->id)
            ->with('success', 'Progress berhasil ditambahkan.');
    }

    public function edit(Progress $progress)
    {
        return view('back.progress.edit', compact('progress'));
    }

    public function update(Request $request, Progress $progress)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'week'        => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'video'       => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/mov|max:50000',
        ]);

        $progress->title       = $request->title;
        $progress->week        = $request->week;
        $progress->description = $request->description;

        if ($request->hasFile('video')) {
            // Hapus video lama jika ada
            if ($progress->video_path && Storage::exists('public/videos/' . $progress->video_path)) {
                Storage::delete('public/videos/' . $progress->video_path);
            }

            $file     = $request->file('video');
            $fileName = uniqid('vid_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/videos', $fileName);
            $progress->video_path = $fileName;
        }

        $progress->save();

        return redirect()->route('progress.index', $progress->project_id)
            ->with('success', 'Progress berhasil diperbarui.');
    }

    public function show(Progress $progress)
    {
        return view('back.progress.show', compact('progress'));
    }

    public function destroy(Progress $progress)
    {
        if ($progress->video_path && Storage::exists('public/videos/' . $progress->video_path)) {
            Storage::delete('public/videos/' . $progress->video_path);
        }

        $progress->delete();

        return response()->json(['message' => 'Progress berhasil dihapus']);
    }
}
