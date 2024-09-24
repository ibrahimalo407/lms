<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\TestResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        if (! Gate::allows('user_access')) {
            return abort(401);
        }
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }
    public function store(Request $request)
    {
        if (! Gate::allows('user_create')) {
            return abort(401);
        }
        $user = User::create($request->only('name','email') + ['password' => bcrypt($request->password)]);
        $user->role()->sync(array_filter((array)$request->input('role')));

        return redirect()->route('admin.users.index');
    }
    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('title', 'id');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request,User $user)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        $user->update($request->only('name','email') + ['password' => bcrypt($request->password)]);
        $user->role()->sync(array_filter((array)$request->input('role')));

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if (! Gate::allows('user_delete')) {
            return abort(401);
        }

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function getUserTests($userId)
    {
        // Récupérer les résultats des tests pour l'utilisateur spécifié avec leurs tests associés
        $tests = TestResult::where('user_id', $userId)->with('test')->get();
        
        // Faites quelque chose avec les tests récupérés, comme les retourner à une vue
        return view('tests.index', ['tests' => $tests]);
    }
}
