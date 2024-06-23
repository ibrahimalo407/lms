<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Group;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\PedagogicalPath;
use App\Http\Controllers\Controller;

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
        $students = User::whereHas('roles', function ($query) {
            $query->where('title', 'student');
        })->get();

        $pedagogicalPaths = PedagogicalPath::all();
        $courses = Course::all();

        return view('admin.groups.create', compact('students', 'pedagogicalPaths'));
    }

    public function edit($id)
    {
        $group = Group::with(['users', 'pedagogicalPaths'])->findOrFail($id);
        $students = User::whereHas('roles', function ($query) {
            $query->where('title', 'Student');
        })->get();

        $pedagogicalPaths = PedagogicalPath::all();

        return view('admin.groups.edit', compact('group', 'students', 'pedagogicalPaths'));
    }

    public function showStudents($groupId)
    {
        $group = Group::with('users')->findOrFail($groupId);
        return view('admin.groups.show_students', compact('group'));
    }

    public function restrictStudent($groupId, $studentId)
    {
        $group = Group::findOrFail($groupId);
        $group->users()->updateExistingPivot($studentId, ['is_restricted' => true]);

        return redirect()->route('admin.groups.showStudents', $groupId)->with('success', 'Student access restricted successfully.');
    }

    public function removeStudent($groupId, $studentId)
    {
        $group = Group::findOrFail($groupId);
        $group->users()->detach($studentId);

        return redirect()->route('admin.groups.showStudents', $groupId)->with('success', 'Student removed successfully.');
    }

    public function showRestrictedStudents($groupId)
    {
        $group = Group::with(['users' => function ($query) {
            $query->wherePivot('is_restricted', true);
        }])->findOrFail($groupId);

        return view('admin.groups.show_restricted_students', compact('group'));
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

    public function show($id)
    {
        $group = Group::with(['users' => function ($query) {
            $query->withPivot('is_restricted');
        }])->findOrFail($id);

        return view('admin.groups.show', compact('group'));
    }

    public function updateRestriction(Request $request, $groupId, $userId)
    {
        $group = Group::findOrFail($groupId);
        $group->users()->updateExistingPivot($userId, ['is_restricted' => $request->is_restricted]);

        return redirect()->route('admin.groups.show', $groupId)->with('success', 'Student restriction updated successfully');
    }

    public function restrictedStudents()
    {
        $users = User::whereHas('groups', function ($query) {
            $query->wherePivot('is_restricted', true);
        })->get();

        return view('admin.groups.restricted', compact('users'));
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
