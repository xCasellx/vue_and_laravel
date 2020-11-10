<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_verified_at', 'first_name','second_name',
        'date_of_birth', 'phone', 'email', 'password',
        "town_id", "folder", "twitter"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function GetCity()
    {
        return $this->select("cities.name as city", "regions.name as region", "countries.name as country")
            ->join("cities", 'cities.id', "=", "users.town_id")
            ->join("regions", 'cities.region_id', "=", "regions.id")
            ->join("countries", 'regions.country_id', "=", "countries.id")
            ->where("users.id", $this->id)->get()[0];
    }
}
