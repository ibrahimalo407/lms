<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, Notifiable;

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
