<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterType extends Model
{
    protected $fillable = [
        'title', 'flag', 'min', 'max'
    ];
}
