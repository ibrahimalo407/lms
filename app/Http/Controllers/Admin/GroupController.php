<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\PedagogicalPath;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        // Charger les relations users et pedagogicalPaths pour chaque groupe
        $groups = Group::with(['users', 'pedagogicalPaths'])->get();
        return view('admin.groups.index', compact('groups'));
    }


    public function create()
    {
        $students = User::whereHas('roles', function($query) {
            $query->where('title', 'student');
        })->get();

        $pedagogicalPaths = PedagogicalPath::all();
        return view('admin.groups.create', compact('students', 'pedagogicalPaths'));
    }

    public function edit(Group $group)
    {
        $students = User::whereHas('roles', function($query) {
            $query->where('title', 'student');
        })->get();

        $pedagogicalPaths = PedagogicalPath::all();
        return view('admin.groups.edit', compact('group', 'students', 'pedagogicalPaths'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'students' => 'nullable|array',
            'students.*' => 'exists:users,id',
            'pedagogical_paths' => 'nullable|array',
            'pedagogical_paths.*' => 'exists:pedagogical_paths,id',
        ]);

        $group = Group::create($data);

        if (isset($data['students'])) {
            $group->users()->sync($data['students']);
        }

        if (isset($data['pedagogical_paths'])) {
            $group->pedagogicalPaths()->sync($data['pedagogical_paths']);
        }

        return redirect()->route('admin.groups.index')->with('success', 'Group created successfully.');
    }

    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'students' => 'nullable|array',
            'students.*' => 'exists:users,id',
            'pedagogical_paths' => 'nullable|array',
            'pedagogical_paths.*' => 'exists:pedagogical_paths,id',
        ]);

        $group->update($data);

        if (isset($data['students'])) {
            $group->users()->sync($data['students']);
        }

        if (isset($data['pedagogical_paths'])) {
            $group->pedagogicalPaths()->sync($data['pedagogical_paths']);
        }

        return redirect()->route('admin.groups.index')->with('success', 'Group updated successfully.');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('admin.groups.index')->with('success', 'Group deleted successfully.');
    }
}


