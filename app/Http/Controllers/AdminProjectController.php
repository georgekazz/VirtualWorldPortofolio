<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
            'thumbnail' => 'required|image|max:2048',
            'screenshots.*' => 'image|max:4096',
            'links' => 'nullable|string',
        ]);

        // Αποθήκευση thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('projects/thumbnails', 'public');

        // Αποθήκευση screenshots (πολλα αρχεία)
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
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Project δημιουργήθηκε με επιτυχία!');
    }
}
