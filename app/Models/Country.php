<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'title',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Get all regions
     *
     * @return $this
     */
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
