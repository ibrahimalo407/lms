<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PedagogicalPath;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PedagogicalPathController extends Controller
{
    public function index()
    {
        $pedagogicalPaths = PedagogicalPath::with('courses')->get();
        return view('admin.pedagogical_paths.index', compact('pedagogicalPaths'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.pedagogical_paths.form', compact('courses'));
    }


    public function edit($id)
    {
        $pedagogicalPath = PedagogicalPath::findOrFail($id);
        $courses = Course::all();
        return view('admin.pedagogical_paths.form', compact('pedagogicalPath', 'courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
            'presentation_video' => 'nullable|file|mimes:mp4,avi,mkv|max:51200'
        ]);

        if ($request->hasFile('presentation_video')) {
            $data['presentation_video'] = $request->file('presentation_video')->store('pedagogical_videos');
        }

        $pedagogicalPath = PedagogicalPath::create($data);

        if (isset($data['courses'])) {
            $pedagogicalPath->courses()->sync($data['courses']);
        }

        return redirect()->route('admin.pedagogical-paths.index')->with('success', 'Pedagogical Path created successfully.');
    }

    public function update(Request $request, PedagogicalPath $pedagogicalPath)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
            'presentation_video' => 'nullable|file|mimes:mp4,avi,mkv|max:51200'
        ]);

        if ($request->hasFile('presentation_video')) {
            if ($pedagogicalPath->presentation_video) {
                Storage::delete($pedagogicalPath->presentation_video);
            }
            $data['presentation_video'] = $request->file('presentation_video')->store('pedagogical_videos');
        }

        $pedagogicalPath->update($data);

        if (isset($data['courses'])) {
            $pedagogicalPath->courses()->sync($data['courses']);
        }

        return redirect()->route('admin.pedagogical-paths.index')->with('success', 'Pedagogical Path updated successfully.');
    }


    public function destroy($id)
    {
        $pedagogicalPath = PedagogicalPath::findOrFail($id);
        Storage::delete($pedagogicalPath->presentation_video);
        $pedagogicalPath->delete();
        return redirect()->route('admin.pedagogical-paths.index')->with('success', 'Pedagogical Path deleted successfully.');
    }

    public function storeMedia(Request $request)
    {
        $path = $request->file('file')->store('pedagogical_videos');
        return response()->json(['name' => $path]);
    }
}

