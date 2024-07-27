<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); //フォームから送信された検索キーワードを取得
        $users = User::where("username" , "like" , "%" . $query . "%")
                    ->where("id" , "!=" , Auth::user()->id)
                    ->get(); //ユーザー名で部分一致検索を実行

        return view('users.search',['users' => $users, 'query' => $query]); //ユーザーと検索ワードをビューに渡す
    }
}
