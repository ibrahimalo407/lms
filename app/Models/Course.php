<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'course_image',
        'start_date',
        'published',
        'classroom_id'
    ];

    // public function classroom()
    // {
    //     return $this->belongsTo(Classroom::class);
    // }

    public function pedagogicalPaths()
    {
        return $this->belongsToMany(PedagogicalPath::class, 'course_pedagogical_path');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function courseRequests()
    {
        return $this->hasMany(CourseRequest::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'course_user');
    }

    public function getPublishedAttribute($attribute)
    {
        return [
            0 => 'Inactive',
            1 => 'Active'
        ][$attribute];
    }

    public function scopeOfTeacher($query)
    {
        if (!auth()->user()->isAdmin()) {
            return $query->whereHas('teachers', function ($q) {
                $q->where('user_id', auth()->user()->id);
            });
        }
        return $query;
    }

    public function publishedLessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('position')->where('published', 1);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('position');
    }

    public function getRatingAttribute()
    {
        return number_format(DB::table('course_student')->where('course_id', $this->attributes['id'])->average('rating'), 2);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }
}
