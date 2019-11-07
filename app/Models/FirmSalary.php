<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirmSalary extends Model
{
    protected $fillable = [
        'firm_id', 'pqe', 'min', 'max'
    ];

    /**
     * Get firm details
     */
    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
}
