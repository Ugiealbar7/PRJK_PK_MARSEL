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
        return view('back.progress.index', [
            'project' => $project
        ]);
    }

    public function store(Request $request, Project $project)
    {
        // Validasi input
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'week' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'nullable|mimes:mp4,avi,mov|max:50000', // Max 50MB
        ]);

        // Upload video
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/videos', $fileName);
            $data['video_path'] = $fileName;
        }

        // Simpan data
        $data['project_id'] = $project->id; // ✅ AMBIL ID-nya DARI MODEL
        Progress::create($data);

        // Redirect
        return redirect()->route('progress.index', $project->id)
            ->with('success', 'Progress berhasil ditambahkan.');
    }

    public function create(Project $project)
    {
        return view('back.progress.create', compact('project'));
    }

    public function destroy(Progress $progress)
    {
        if ($progress->video_path && \Storage::exists('public/videos/' . $progress->video_path)) {
            \Storage::delete('public/videos/' . $progress->video_path);
        }

        $progress->delete();

        return response()->json(['message' => 'Progress berhasil dihapus']);
    }

    public function edit(Progress $progress)
    {
        return view('back.progress.edit', compact('progress'));
    }

    public function update(Request $request, Progress $progress)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'week' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'nullable|mimes:mp4,avi,mov|max:50000',
        ]);

        // Ganti video kalau ada yang baru
        if ($request->hasFile('video')) {
            // Hapus video lama
            if ($progress->video_path) {
                \Storage::delete('public/videos/' . $progress->video_path);
            }

            $file = $request->file('video');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/videos', $fileName);
            $data['video_path'] = $fileName;
        }

        $progress->update($data);

        return redirect()->route('progress.index', $progress->project_id)
            ->with('success', 'Progress berhasil diperbarui.');
    }

    public function show(Progress $progress)
    {
        return view('back.progress.show', compact('progress'));
    }


}
