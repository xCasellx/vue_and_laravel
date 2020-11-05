<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use function GuzzleHttp\Promise\all;

class UserUpdateController extends Controller
{
    public function index()
    {

        return view("update");
    }

    public function getUpdateData()
    {
        $user = Auth::user();
        $user["town_id"] = User::select("cities.id as city_id" , "countries.id as country_id" , "regions.id as region_id")
            ->join("cities" , 'cities.id', "=" , "users.town_id")
            ->join("regions" , 'cities.region_id', "=" , "regions.id")
            ->join("countries" , 'regions.country_id', "=" , "countries.id")
            ->where("users.id", $user["id"])->get()[0];
        $user["image"] = ($user["folder"] === null)?  asset('images/nan.png') : asset("users/".$user["folder"].'/avatar.png?'.time());

        return response()->json($user);
    }

    public function PostUpdateData(Request $request)
    {
        $user = Auth::user();
        $date = (date('Y')-5).date('-m-d');
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date',"before:$date"],
            'phone' => ['required'],
            'city_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user["id"]],
        ]);

        $data = $request->all();
        User::where("id",$user["id"])->update([
            'first_name' => $data['first_name'],
            'second_name' => $data['second_name'],
            'date_of_birth' => $data['date_of_birth'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'town_id' => $data['city_id'],
        ]);
        return response()->json(array(
            "status" => "success",
            "message"=> 'Update success'
        ));
    }
    public function PostUpdatePassword(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        if(!Hash::check($request->input('password'),$user->getAuthPassword())) {
            return response()->json(array(
             "errors" => ["password" =>['']]
            ),422);
        }
        $request->validate(['new_password' => ['required', 'string', 'min:8', 'confirmed']]);

        User::where("id",$user["id"])->update([
            "password" => Hash::make($data['new_password'])
        ]);

        return response()->json(array(
            "status" => "success",
            "message"=> 'Password update success'
        ));
    }

    public function PostUpdateImage(Request $request)
    {   $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
        $user = Auth::user();
        $file = $request->file('image');
        $directory = public_path("users\\user-$user->id\\");
        if(!File::exists($directory)){
            File::makeDirectory($directory, 0777);
        }
        $filename = 'avatar.png';
        $file->move($directory, $filename);
        User::where("id",$user["id"])
            ->update(["folder" => "user-$user->id"]);
        return response()->json(array(
            "status" => "success",
            "message"=> 'Image update success'
        ));
    }
}
