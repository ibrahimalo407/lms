<?php
// app/Models/Meeting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'meeting_id', 'description', 'start_time', 'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
