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
        ]);

        // Αποθήκευση thumbnail στο disk 'public'
        $thumbnailPath = $request->file('thumbnail')->store('projects/thumbnails', 'public');

        // Αποθήκευση screenshots (multiple) στο disk 'public'
        $screenshotsPaths = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $file) {
                $screenshotsPaths[] = $file->store('projects/screenshots', 'public');
            }
        }

        // Δημιουργία Project στη βάση
        $project = Project::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            // Αποθηκεύω μόνο το path (χωρίς Storage::url), για να χρησιμοποιήσω asset('storage/...') μετά
            'thumbnail' => $thumbnailPath,
            'screenshots' => json_encode($screenshotsPaths),
            'links' => $request->links,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Το project αποθηκεύτηκε επιτυχώς!');
    }
}
