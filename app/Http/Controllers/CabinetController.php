<?php

namespace App\Http\Controllers;

use App\Models\City;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    protected function index()
    {
        return view("cabinet");
    }

    public function getUserData()
    {
        $user = Auth::user();

        $user["town"] = City::select("cities.name as city", "regions.name as region" ,"countries.name as country")
            ->join("regions" , 'cities.region_id', "=" , "regions.id")
            ->join("countries" , 'regions.country_id', "=" , "countries.id")
            ->where("cities.id", $user["town_id"])
            ->get()[0];
        $user["image"] = ($user["folder"] === null)? asset('images/nan.png') : asset("users/".$user["folder"].'/avatar.png?'.time());
        return response()->json($user);
    }


}
