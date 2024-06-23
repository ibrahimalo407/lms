<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_restricted');
    }

    public function pedagogicalPaths()
    {
        return $this->belongsToMany(PedagogicalPath::class, 'group_pedagogical_path');
    }
}
