<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParseData extends Model
{
    protected $fillable = [
        'link', 'title', 'image', 'price',
        'type_of_fuel', 'mileage', 'description', 'year_of_issue',

    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
