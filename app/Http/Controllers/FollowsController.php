<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Follow;

class FollowsController extends Controller
{
    //
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
        // フォロー
    public function follow(Request $request)
    {
        $follower = auth()->user();
        $followed_id = $request->input('followed_id');
        // フォローしているか
        $is_following = $follower->isFollowing($followed_id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($followed_id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(Request $request)
    {
        $follower = auth()->user();
        $followed_id = $request->input('followed_id');
        // フォローしているか
        $is_following = $follower->isFollowing($followed_id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($followed_id);
            return back();
        }
    }

}
