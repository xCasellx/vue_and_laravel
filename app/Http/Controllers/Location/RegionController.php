<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index($id)
    {
        $region = Region::where("country_id", $id)->get();
        return response()->json($region);
    }
}
