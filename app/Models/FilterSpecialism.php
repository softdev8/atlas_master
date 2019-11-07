<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterSpecialism extends Model
{
    protected $fillable = [
        'title', 'area_id'
    ];

    /**
     * Get Practice Area details
     */
    public function area()
    {
        return $this->belongsTo(FilterPracticeArea::class);
    }
}
