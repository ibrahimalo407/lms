<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['assignment_id', 'student_id', 'group_id', 'status', 'grade', 'badge_points'];


    // Relation avec le modèle User (étudiant)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    // Relation avec le modèle Group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Relation avec les soumissions
    public function submissions()
    {
        return $this->hasMany(StudentSubmission::class);
    }
}
