<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostsController extends Controller
{
    //Auth認証の方を修正したら解除
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    public function index()
    {
        $user = Auth::user(); //ログイン認証しているユーザーを取得

        $posts = Post::all(); //Postテーブルからレコード情報を取得

        return view('posts.index',['posts' => $posts,'user' => $user]); //index.bladeへ送る
    }

    public function store(Request $request)
    {
        //投稿処理のバリテーション（入力必須、150文字以内）
        $request->validate([
            'post' => 'required|max:150',
        ]);

        //ログインいているユーザーのIDの読み込み
        $id = Auth::id();
        //インスタンス作成
        $post = new Post();
        //投稿内容を設定
        $post->post = $request->input('post');
        //ユーザーIDを設定
        $post->user_id = $id;
        //データベースに保存
        $post->save();
        //新規投稿ページへリダイレクト
        //storeの時は2重送信の可能性がある為redirect
        return redirect()->route('top');
    }

    public function edit($id)
    {
        $user = Auth::user(); // ログイン認証しているユーザーを取得
        $post = Post::findOrFail($id); // IDで該当の投稿を取得

        return view('posts.edit', ['post' => $post, 'user' => $user]); // 編集ビューへ送る
    }

    public function update(Request $request)
    {
    // 投稿処理のバリテーション（入力必須、150文字以内）
    $request->validate(['post' => 'required|max:150',]);

    $id = $request->input('id');
    $post = Post::findOrFail($id); // IDで該当の投稿を取得
    // 投稿内容を設定
    $post->post = $request->input('post');
    // データベースに保存
    $post->save();
    // トップページへリダイレクト
    return redirect()->route('top');
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $post = Post::findOrFail($id); // IDで該当の投稿を取得
        $post->delete();
        return redirect()->route('top');
    }

}
