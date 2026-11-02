<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::latest()->get();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'teknologi' => 'required',
            'status' => 'required|in:selesai,In Progress',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        $imagePath = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $imagePath);

        Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'teknologi' => $validated['teknologi'],
            'image' => $imagePath,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.project.index')->with('success', 'Project berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $project = Project::findOrFail($id);
        return view('admin.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'teknologi' => 'required',
            'status' => 'required|in:selesai,In Progress',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        $project = Project::findOrFail($id);
        $imagePath = $project->image; // Default to existing image path

        if ($request->hasFile('image')) {
            // hapus gambar lama kalo ada wok
        //     if ($project->image && file_exists(public_path('images/' . $project->image))) {
        //         unlink(public_path('images/' . $project->image));
        //     }

            $imagePath = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imagePath);
            $project->image = $imagePath;
        }
        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'teknologi' => $request->teknologi,
            "image" => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.project.index')->with('success', 'Project berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $project = Project::findOrFail($id);
        if ($project->image && file_exists(public_path('images/' . $project->image))) {
            unlink(public_path('images/' . $project->image));
        }
        $project->delete();
        return redirect()->route('admin.project.index')->with('success', 'Project berhasil dihapus.');
    }
}
