<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['student_assignment_id', 'submission_text', 'submission_file', 'submitted_at'];

    // Relation avec le modèle StudentAssignment
    public function studentAssignment()
    {
        return $this->belongsTo(StudentAssignment::class);
    }

    
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
