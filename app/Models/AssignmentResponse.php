<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'response_text',
        'response_file',
        'grade',
    ];
    // Define the relationship to the Assignment model
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
