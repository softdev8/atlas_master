<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateLink extends Model
{
    protected $fillable = [
        'candidate_id', 'link',
    ];
}
