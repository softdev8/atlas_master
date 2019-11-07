<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateSubSpecialism extends Model
{
    protected $fillable = [
        'candidate_id', 'area_id', 'specialism_id', 'subspecialism_id',
    ];

    /**
     * Get candidate details
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    /**
     * Get area details
     */
    public function area()
    {
        return $this->belongsTo(FilterPracticeArea::class);
    }

    /**
     * Get specialism details
     */
    public function specialism()
    {
        return $this->belongsTo(FilterSpecialism::class);
    }

    /**
     * Get specialism details
     */
    public function subspecialism()
    {
        return $this->belongsTo(FilterSubSpecialism::class);
    }
}
