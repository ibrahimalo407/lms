<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    // Ajouter les champs à la propriété $fillable
    protected $fillable = [
        'meeting_id',
        'student_id',
        'meeting_link',
    ];

    // Relation avec la réunion
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    // Relation avec l'étudiant
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
