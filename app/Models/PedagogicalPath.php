<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedagogicalPath extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'presentation_video'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_pedagogical_path');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_pedagogical_path');
    }

    public function getPresentationVideoUrlAttribute()
    {
        return Storage::url($this->presentation_video);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'path_student', 'path_id', 'student_id');
    }
}
