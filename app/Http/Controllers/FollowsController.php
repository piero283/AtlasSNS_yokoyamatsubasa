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
}
