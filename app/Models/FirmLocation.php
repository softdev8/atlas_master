<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirmLocation extends Model
{
    protected $fillable = [
        'firm_id', 'country_id', 'region_id', 'city_id', 'address',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $with = [
        'country', 'region', 'city',
    ];

    /**
     * Get firm details
     */
    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }

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

    /**
     * Get city details
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
