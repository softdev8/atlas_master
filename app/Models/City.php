<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'title', 'country_id', 'region_id'
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

    /**
     * Get region details
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
