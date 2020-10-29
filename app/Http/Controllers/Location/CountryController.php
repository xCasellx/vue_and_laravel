<?php

namespace App\Http\Controllers\Location;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index()
    {
        return response()->json(Country::all());
    }
}
