<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
