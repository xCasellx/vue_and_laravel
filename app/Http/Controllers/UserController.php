<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Thujohn\Twitter\Facades\Twitter;

class UserController extends Controller
{

    public function getAuthUserData()
    {
        $user = Auth::user();

        $user["town"] = User::select("cities.name as city", "regions.name as region", "countries.name as country")
            ->join("cities", 'cities.id', "=", "users.town_id")
            ->join("regions", 'cities.region_id', "=", "regions.id")
            ->join("countries", 'regions.country_id', "=", "countries.id")
            ->where("users.id", $user["id"])->get()[0];
        $user["image"] = ($user["folder"] === null) ? asset('images/nan.png') : asset("users/" . $user["folder"] . '/avatar.png?' . time());
        return response()->json($user);
    }

    public function getUserData($id)
    {
        $user = User::where("id", $id)->get()[0];

        $user["town"] = User::select("cities.name as city", "regions.name as region", "countries.name as country")
            ->join("cities", 'cities.id', "=", "users.town_id")
            ->join("regions", 'cities.region_id', "=", "regions.id")
            ->join("countries", 'regions.country_id', "=", "countries.id")
            ->where("users.id", $user["id"])->get()[0];
        $user["image"] = ($user["folder"] === null) ? asset('images/nan.png') : asset("users/" . $user["folder"] . '/avatar.png?' . time());
        return response()->json($user);
    }
}
