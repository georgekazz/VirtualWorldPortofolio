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
            'title' => 'required|string',
            'short_description' => 'required|string',
            'full_description' => 'required|string',
            'thumbnail' => 'nullable|image',
            'screenshots.*' => 'nullable|image',
        ]);

        $thumbnailPath = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('projects', 'public')
            : null;

        $screenshotsPaths = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshot) {
                $screenshotsPaths[] = $screenshot->store('projects', 'public');
            }
        }

        $links = array_filter(array_map('trim', explode("\n", $request->input('links'))));

        Project::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'thumbnail' => $thumbnailPath,
            'screenshots' => $screenshotsPaths,
            'links' => $links,
        ]);

        return redirect()->route('projects.index')->with('success', 'Το project προστέθηκε επιτυχώς.');
    }
}
