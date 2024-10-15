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

    // public function count()
    // {
    //     $user = auth()->user();
    //     $follow_count = Follow::where('following_id', $user->id)->count(); //ユーザーがフォローしている数を取得
    //     $follower_count = Follow::where('followed_id', $user->id)->count(); //ユーザーをフォローしている数を取得

    //     return view('layouts.login', ['user' => $user,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    // }

    public function followList()
    {
        $user = auth()->user();
        $follow_count = Follow::where('following_id', $user->id)->count(); //ユーザーがフォローしている数を取得
        $follower_count = Follow::where('followed_id', $user->id)->count(); //ユーザーをフォローしている数を取得

        $followedUsers = $user->follows()->with('posts')->get(); // フォローしているユーザーとその投稿を取得
        return view('follows.followList', ['followedUsers' => $followedUsers,'user' => $user,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    }

    public function followerList()
    {
        $user = auth()->user();
        $follow_count = Follow::where('following_id', $user->id)->count(); //ユーザーがフォローしている数を取得
        $follower_count = Follow::where('followed_id', $user->id)->count(); //ユーザーをフォローしている数を取得

        $followers = $user->followers()->with('posts')->get(); // フォロワーとその投稿を取得
        return view('follows.followerList', ['followers' => $followers,'user' => $user,'follow_count' => $follow_count,'follower_count' => $follower_count]);

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
        $follow_count = Follow::where('followed_id', $user->id)->count();
        $follower_count = Follow::where('following_id', $user->id)->count();

        return view('users.profile', ['user' => $user,'follow_count' => $follow_count,'follower_count' => $follower_count]);
    }

}
