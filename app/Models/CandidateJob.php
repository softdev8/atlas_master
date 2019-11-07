<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateJob extends Model
{
    protected $fillable = [
        'candidate_id', 'previous_firm', 'previous_date',
    ];

    /**
     * Get candidate details
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
