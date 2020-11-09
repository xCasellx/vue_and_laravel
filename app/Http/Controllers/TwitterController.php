<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function getTweetsUser($user, $count)
    {
        $connect = new TwitterOAuth(
            config("services.twitter.consumer_key"),
            config("services.twitter.consumer_secret"),
            config("services.twitter.access_token"),
            config("services.twitter.access_token_secret")
        );
          $tweets = $connect->get("statuses/user_timeline",["screen_name" => $user, "count" => $count,
                                        "tweet_mode" => "extended"]);
        return response()->json($tweets);
    }
}
