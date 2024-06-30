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

        return view('posts.index',['posts' => $posts,]); //index.bladeへ送る
    }

    public function create(){
        return view('post/create'); //新規作成のページへ飛ばす

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
        return redirect()->route('post.create');
    }
}
