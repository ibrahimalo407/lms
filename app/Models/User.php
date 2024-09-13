<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Test;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'zoom_id',
        'zoom_token',
    ];

    public function virtualClasses()
    {
        return $this->hasMany(VirtualClass::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function isAdmin()
    {
        return $this->role()->where('role_id', 1)->first();
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_student');
    }

    public function tests()
    {
        return $this->hasMany(TestResult::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')->withPivot('rating');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($roleTitle)
    {
        return $this->roles()->where('title', $roleTitle)->exists();
    }

    public function hasPermission($permission)
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('title', $permission);
        })->exists();
    }

    // public function groups()
    // {
    //     return $this->belongsToMany(Group::class, 'group_user');
    // }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'student_id');
    }


    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id');
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'student_assignments')
            ->withPivot('status', 'grade', 'badge_points')
            ->withTimestamps();
    }

    public function submissions()
    {
        return $this->hasMany(StudentSubmission::class, 'student_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class)
            ->withPivot('badge_points')
            ->withTimestamps();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // app/Models/User.php

    public function isStudent()
    {
        return $this->roles()->where('title', 'student')->exists();
    }


    public function studentAssignments()
    {
        return $this->hasMany(StudentAssignment::class, 'student_id');
    }


    // public function isAdmin()
    // {
    //     return $this->role === 'admin';
    // }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }
}
