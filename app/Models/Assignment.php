<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', 'course_id','group_id', 'due_date'];

    protected $dates = ['due_date'];


        // Rela tion avec le modèle Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function studentAssignments()
    {
        return $this->hasMany(StudentAssignment::class);
    }

    // Relation avec les étudiants via la table pivot `student_assignments`


    // Relation avec les groupes via la table pivot `student_assignments`
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'student_assignments')
            ->withPivot('status', 'grade', 'badge_points')
            ->withTimestamps();
    }

    // Relation avec les soumissions
    public function submissions()
    {
        return $this->hasMany(StudentSubmission::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_assignments', 'assignment_id', 'student_id')
            ->withPivot('status', 'grade', 'badge_points')
            ->withTimestamps();
    }


}
