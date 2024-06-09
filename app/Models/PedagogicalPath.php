<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
