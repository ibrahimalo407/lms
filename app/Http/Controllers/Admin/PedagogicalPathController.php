<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PedagogicalPath;
use Illuminate\Http\Request;

class PedagogicalPathController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'groupOrPathPermission:pedagogical_path_access']);
    }

    public function index()
    {
        $pedagogicalPaths = PedagogicalPath::all();
        return view('admin.pedagogical_paths.index', compact('pedagogicalPaths'));
    }

    public function create()
    {
        return view('admin.pedagogical_paths.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'presentation_video' => 'nullable|file|mimes:mp4,avi,mov|max:20480',
        ]);

        $pedagogicalPath = new PedagogicalPath($request->all());

        if ($request->hasFile('presentation_video')) {
            $path = $request->file('presentation_video')->store('videos', 'public');
            $pedagogicalPath->presentation_video = $path;
        }

        $pedagogicalPath->save();

        return redirect()->route('admin.pedagogical-paths.index')->with('success', 'Pedagogical Path created successfully.');
    }

    public function edit($id)
    {
        $pedagogicalPath = PedagogicalPath::findOrFail($id);
        return view('admin.pedagogical_paths.form', compact('pedagogicalPath'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'presentation_video' => 'nullable|file|mimes:mp4,avi,mov|max:20480',
        ]);

        $pedagogicalPath = PedagogicalPath::findOrFail($id);
        $pedagogicalPath->fill($request->all());

        if ($request->hasFile('presentation_video')) {
            $path = $request->file('presentation_video')->store('videos', 'public');
            $pedagogicalPath->presentation_video = $path;
        }

        $pedagogicalPath->save();

        return redirect()->route('admin.pedagogical-paths.index')->with('success', 'Pedagogical Path updated successfully.');
    }

    public function destroy($id)
    {
        $pedagogicalPath = PedagogicalPath::findOrFail($id);
        $pedagogicalPath->delete();

        return redirect()->route('admin.pedagogical-paths.index')->with('success', 'Pedagogical Path deleted successfully.');
    }
}
