<?php

namespace App\Http\Controllers\Back;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
   
    public function index()
    {
        if (request()->ajax()) {
            $projects = Project::with('Category')->latest()->get();

            // Custom Kolom
            return DataTables::of($projects)
                ->addIndexColumn()

                ->addColumn('category_id', function ($projetcs) {
                    return $projetcs->Category->name;
                })

                ->addColumn('status', function ($projetcs) {
                    if ($projetcs->status == 0) {
                        return '<span class="badge bg-danger">Private</span>';
                    } else {
                        return '<span class="badge bg-success">Published</span>';
                    }

                })

                ->addColumn('button', function ($projetcs) {
                    return '<div class="text-center">
                                <a href="projects/' . $projetcs->id . '" class="btn btn-secondary">Detail</a>
                                <a href="projects/' . $projetcs->id . ' /edit" class="btn btn-primary">Edit</a>
                                <a href="#" onclick="deleteProject(this)" data-id="' . $projetcs->id . '" class="btn btn-danger">Delete</a>
                            </div>';

                })

                //panggil custom kolom
                ->rawColumns(['category_id', 'status', 'button'])
                ->make();
        }

        return view('back.project.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.project.create', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validasi input form
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'desc' => 'required|string',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:0,1',
        'publish_date' => 'required|date',
    ]);

    $project = new Project();
    $project->title = $request->title;
    $project->category_id = $request->category_id;
    $project->desc = $request->desc;

    if ($request->hasFile('img')) {
        $path = $request->file('img')->store('back', 'public'); // simpan di storage/app/public/back
        $project->img = basename($path);
    }

    $project->slug = \Illuminate\Support\Str::slug($request->title);
    $project->status = $request->status;
    $project->publish_date = $request->publish_date;
    $project->views = 0; // default views

    $project->save();

    return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('back.project.show', [
            'project' => Project::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('back.project.update', [
            'project' => Project::find($id),
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/back', $fileName);

            // unlink img/delete old img
            Storage::delete('public/back/' . $request->oldImg);

            $data['img'] = $fileName;
        } else {
            $data['img'] = $request->oldImg;
        }



        $data['slug'] = Str::slug($data['title']);

        Project::find($id)->update($data);

        return redirect(url('projects'))->with('success', 'Data project has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Project::find($id);
        Storage::delete('public/back/' . $data->img);
        $data->delete();

        return response()->json([
            'message' => 'Data project has been deleted'
        ]);

    }

    public function progress()
{
    return $this->hasMany(\App\Models\Progress::class);
}

}
