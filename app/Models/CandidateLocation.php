<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateLocation extends Model
{
    protected $fillable = [
        'candidate_id', 'location_id', 'description',
    ];


    protected $with = [
        'location'
    ];

    /**
     * Get candidate details
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    /**
     * Get region details
     */
    public function location()
    {
        return $this->belongsTo(FirmLocation::class);
    }
}
