<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'title', 'country_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Get country details
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
