<?php

namespace App\Http\Controllers;

use App\Mail\CommentShipped;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    public function index()
    {
        return view("comments");
    }

    public function getCommentsList()
    {
        $comment = Comment::where("parent_id", null)->select("comments.*","users.first_name", "users.second_name", "users.folder")
            ->join("users", "comments.user_id", "users.id")->get();

        foreach ($comment as $key => $value) {
            $comment[$key]["child"] = $this->mass($value);
            $comment[$key]["access"] = (Auth::id() === $comment[$key]["user_id"])? true : false;
            $comment[$key]["image"] = ($comment[$key]["folder"] === null)? 'images/nan.png' : "users/".$comment[$key]["folder"].'/avatar.png?'.time();
        }
        //dd($comment);
        return response()->json($comment);
    }

    public function create(Request $request)
    {
        $request->validate([
            "text" => ['required', 'string', 'max:512']
        ]);
        $text = $request["text"];
        $parent_id = $request["parent_id"];
        $comm = Comment::create([
            "text" => $text,
            "user_id" => Auth::user()["id"],
            "parent_id" => $parent_id
        ]);
        Mail::to(Auth::user())->send(new CommentShipped($comm, false));
        if($parent_id !== null) {
            $user = Comment::where("parent_id", $parent_id)->select("users.email")
                ->join("users", "comments.user_id", "users.id")->get();

            $c = Comment::where("comments.id", $comm["id"])->select("comments.*","users.first_name", "users.second_name")
                ->join("users", "comments.user_id", "users.id")->get()[0];
            Mail::to($user)->send(new CommentShipped($c,true));
        }
        return response()->json([
            'message' =>'Comment created'
        ]);
    }

    public function update(Request $request)
    {
        $comment_id = $request["comment_id"];
        $comment = Comment::find($comment_id);
        if($comment->user_id === Auth::user()->id)
        {
            $request->validate([
                "text" => ['required', 'string', 'max:512']
            ]);
            $text = $request["text"];

            Comment::find($comment_id)
                ->update(["text" => $text]);
            return response()->json([
                'message' =>'Edit success'
            ]);
        }
        return response()->json([
            'message' =>'Edit error'
        ]);
    }


    public function delete($id)
    {
        $comment = Comment::find($id);
        if($comment->user_id === Auth::user()->id)
        {
            $comment->delete();
            return response()->json([
                'message' =>'Deleted success'
            ]);
        }
        return response()->json([
            'message' =>'Deleted error'
        ]);
    }


    public  function mass($arr)
    {
        $comment = Comment::where("parent_id", $arr["id"])->select("comments.*","users.first_name", "users.second_name","users.folder")
            ->join("users", "comments.user_id", "users.id")->get();
        foreach ($comment as $key => $value) {
            $comment[$key]["child"] = $this->mass($value);
            $comment[$key]["access"] = (Auth::id() === $comment[$key]["user_id"])? true : false;
            $comment[$key]["image"] = ($comment[$key]["folder"] === null)? 'images/nan.png' : "users/".$comment[$key]["folder"].'/avatar.png?'.time();
        }
        return $comment;
    }
}
