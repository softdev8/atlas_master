<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterSubSpecialism extends Model
{
    protected $fillable = [
        'title', 'specialism_id'
    ];

    /**
     * Get Specialism details
     */
    public function specialism()
    {
        return $this->belongsTo(FilterSpecialism::class, 'specialism_id' , 'id');
    }
}