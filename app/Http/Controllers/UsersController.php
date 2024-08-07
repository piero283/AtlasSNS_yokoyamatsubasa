<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    public function profile(){
    $user = auth()->user();
    return view('users.edit',['user' => $user]);
    }

    public function update(Request $request){
    $request->validate([
        'username' =>'required|between:2,12',
        'mail' => 'required|between:5,40|email:filter,dns',
        'password' => 'required|between:8,20|alpha-num|confirmed:password',
        'bio' => 'nullable|string|max:150',
        'images' => 'nullable|image|mimes:jpg,png,bmp,gif,svg',
        ]);
    $user = auth()->user();

    // 画像のアップロード処理
    $uploadFile = $request->file('images');
    if (!empty($uploadFile)) {
    // 画像ファイルが存在する場合
    $thumbnailName = $uploadFile->hashName(); // ユニークなファイル名を生成
    $uploadFile->storeAs('public/profile_images', $thumbnailName); // ストレージに保存

    // ユーザーの images フィールドを更新
    $user->images = $thumbnailName;}

    // 他のフィールドの更新
    $user->username = $request->input('username');
    $user->mail = $request->input('mail');
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }
    $user->bio = $request->input('bio');

    // ユーザー情報を保存
    $user->save();

    return redirect('/profile')->with('success', 'プロフィールが更新されました');
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
