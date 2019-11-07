<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCandidate extends Model
{
    protected $fillable = [
        'candidate_id', 'project_id'
    ];
}
