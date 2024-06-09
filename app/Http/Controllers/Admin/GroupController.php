<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\PedagogicalPath;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with(['students', 'pedagogicalPaths'])->get(); // Assuming you have a pedagogicalPaths relationship
        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Group::create($request->all());

        return redirect()->route('admin.groups.index')->with('success', 'Group created successfully.');
    }

    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $students = User::whereHas('roles', function($query) {
            $query->where('title', 'student');
        })->get();
        $paths = PedagogicalPath::all();

        return view('admin.groups.edit', compact('group', 'students', 'paths'));
    }

    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group->update($request->all());

        return redirect()->route('admin.groups.index')->with('success', 'Group updated successfully.');
    }

    public function assignPaths(Request $request, $groupId)
    {
        $group = Group::findOrFail($groupId);
        $group->pedagogicalPaths()->sync($request->path_ids);

        return redirect()->route('admin.groups.edit', $group->id)->with('success', 'Pedagogical Paths assigned successfully.');
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->route('admin.groups.index')->with('error', 'Group deleted successfully.');
    }

    public function addStudent(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $student = User::findOrFail($request->student_id);
        $group->students()->attach($student);

        return redirect()->back()->with('success', 'Student added successfully.');
    }

    public function removeStudent($groupId, $studentId)
    {
        $group = Group::findOrFail($groupId);
        $student = User::findOrFail($studentId);
        $group->students()->detach($student);

        return redirect()->back()->with('error', 'Student removed successfully.');
    }

    public function restrictStudent($groupId, $studentId)
    {
        // Logic to restrict student access
        return redirect()->back()->with('success', 'Student access restricted.');
    }
}

