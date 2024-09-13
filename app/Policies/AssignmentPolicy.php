<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Assignment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create an assignment.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Administrator (can create other users)') || $user->hasRole('teacher');
    }

    /**
     * Determine whether the user can view the assignment.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Assignment $assignment
     * @return mixed
     */
    public function view(User $user, Assignment $assignment)
    {
        return $user->hasRole('Administrator (can create other users)') || $user->hasRole('teacher') || $assignment->students->contains($user);
    }


    public function viewSubmissions(User $user, Assignment $assignment)
    {
        // Permet aux admins et aux professeurs d'accéder aux soumissions
        return $user->isAdmin() || $user->isTeacher();
    }

    // Ajoutez d'autres méthodes de politique si nécessaire
}
