<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    //
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    public function followList()
    {
        $user = auth()->user();
        $followedUsers = $user->follows()->with('posts')->get(); // フォローしているユーザーとその投稿を取得
        return view('follows.followList', ['followedUsers' => $followedUsers]);
    }

    public function followerList()
    {
        $user = auth()->user();
        $followers = $user->followers()->with('posts')->get(); // フォロワーとその投稿を取得
        return view('follows.followerList', ['followers' => $followers]);
    }


    // フォロー
    public function follow(Request $request)
    {
        $follower = auth()->user(); //ログインユーザーを取得
        $followed_id = $request->input('followed_id'); //フォローするユーザーIDをリクエストから取得
        // フォローしているか確認
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
        // フォローしているか確認
        $is_following = $follower->isFollowing($followed_id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($followed_id);
            return back();
        }
    }

    public function show(User $user)
    {
        return view('users.profile', compact('user'));
    }

}
