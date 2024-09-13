<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'points_required'];

    // Badges peuvent être associés à des étudiants via les points
    public function students()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('badge_points')
                    ->withTimestamps();
    }
}

