<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = [
        'user_id', 'criterias', 'title', 'results', 'last_run'
    ];
}
