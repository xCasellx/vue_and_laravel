<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function test ()
    {
        $test = User::find(Auth::id())->GetCity();
        return response()->json($test);
    }
    public function getAuthUserData()
    {
        $user = Auth::user();
        $user["auth"] = true;
        $user["town"] = User::find($user->id)->GetCity();
        $user["image"] = ($user["folder"] === null) ? asset('images/nan.png') : asset("users/" . $user["folder"] . '/avatar.png?' . time());
        return response()->json($user);
    }
    public function getUserData($id)
    {
        $user = [];
        if( Auth::id() == $id ) {
            $user = Auth::user();
            $user["auth"] = true;
        }
        else {
            $user = User::where("id", $id)->get()[0];
            $user["auth"] = false;
        }
        $user["town"] = User::find($id)->GetCity();
        $user["image"] = ($user["folder"] === null) ? asset('images/nan.png') : asset("users/" . $user["folder"] . '/avatar.png?' . time());
        return response()->json($user);
    }
}
