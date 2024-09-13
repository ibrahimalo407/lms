<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'content', 'read_at'];

    // Relation avec le modèle User (étudiant)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
