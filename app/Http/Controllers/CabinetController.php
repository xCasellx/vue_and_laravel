<?php

namespace App\Http\Controllers;

use App\Models\City;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    public function index()
    {
        return view("cabinet");

    }

    public function userCabinet($id)
    {
        return view("account")->with("id", $id);
    }
}
