<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('projects'));
    }

    // Αποθήκευση νέου project
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
            'thumbnail' => 'required|image|max:2048',  // Μέγιστο 2MB
            'screenshots.*' => 'nullable|image|max:4096', // Μέχρι 4MB ανά εικόνα
            'links' => 'nullable|string|max:1000',
            'education_level' => 'nullable|string',
            'class_level' => 'nullable|string',
            'year' => 'nullable|integer|min:2012|max:' . date('Y'),
            'project_type' => 'nullable|string',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('projects/thumbnails', 'public');

        $screenshotsPaths = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $file) {
                $screenshotsPaths[] = $file->store('projects/screenshots', 'public');
            }
        }

        $project = Project::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'thumbnail' => $thumbnailPath,
            'screenshots' => json_encode($screenshotsPaths),
            'links' => $request->links,
            'education_level' => $request->input('education_level'),
            'class_level' => $request->input('class_level'),
            'year' => $request->input('year'),
            'project_type' => $request->input('project_type'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Το project αποθηκεύτηκε επιτυχώς!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Το project διαγράφηκε επιτυχώς!');
    }

    public function edit(Project $project)
    {
        return view('admin.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'screenshots.*' => 'nullable|image|max:4096',
            'links' => 'nullable|string|max:1000',
            'education_level' => 'nullable|string',
            'class_level' => 'nullable|string',
            'year' => 'nullable|integer|min:2012|max:' . date('Y'),
            'project_type' => 'nullable|string',
        ]);

        // Αν ανεβάστηκε νέο thumbnail, αποθήκευσέ το
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('projects/thumbnails', 'public');
            $project->thumbnail = $thumbnailPath;
        }

        // Αν ανεβάστηκαν νέα screenshots, αποθήκευσέ τα (και αντικατέστησε τα παλιά)
        if ($request->hasFile('screenshots')) {
            $screenshotsPaths = [];
            foreach ($request->file('screenshots') as $file) {
                $screenshotsPaths[] = $file->store('projects/screenshots', 'public');
            }
            $project->screenshots = json_encode($screenshotsPaths);
        }

        // Ενημέρωσε τα υπόλοιπα πεδία
        $project->title = $request->title;
        $project->short_description = $request->short_description;
        $project->full_description = $request->full_description;
        $project->links = $request->links;
        $project->education_level = $request->education_level;
        $project->class_level = $request->class_level;
        $project->year = $request->year;
        $project->project_type = $request->project_type;

        $project->save();

        return redirect()->route('admin.dashboard')->with('success', 'Το project ενημερώθηκε επιτυχώς!');
    }
}
