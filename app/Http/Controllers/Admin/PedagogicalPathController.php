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

    
    public function store(Request $request)
    {
        $data = $request->all();
        $path = $request->file('presentation_video') ? $request->file('presentation_video')->store('pedagogical_videos') : null;
        $data['presentation_video'] = $path;

        $pedagogicalPath = PedagogicalPath::create($data);
        $pedagogicalPath->courses()->sync($request->input('courses', []));

        return redirect()->route('admin.pedagogical-paths.index')->with('success', 'Pedagogical Path created successfully');
    }

    public function edit($id)
    {
        $pedagogicalPath = PedagogicalPath::findOrFail($id);
        $courses = Course::all();
        return view('admin.pedagogical_paths.form', compact('pedagogicalPath', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $pedagogicalPath = PedagogicalPath::findOrFail($id);
        $data = $request->all();

        if ($request->file('presentation_video')) {
            Storage::delete($pedagogicalPath->presentation_video);
            $path = $request->file('presentation_video')->store('pedagogical_videos');
            $data['presentation_video'] = $path;
        }

        $pedagogicalPath->update($data);
        $pedagogicalPath->courses()->sync($request->input('courses', []));

        return redirect()->route('admin.pedagogical-paths.index')->with('success', 'Pedagogical Path updated successfully');
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

