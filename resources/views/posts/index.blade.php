@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/index']) !!}
<div id="top">
  <div id="form">
    <h1 class="posts">
      <img src="{{asset('/images/icon1.png')}}" class="icon1-image">
      <input type="text" name="PostText" placeholder="投稿内容を入力ください" class="post-text" required>
      <button type="submit" class="post-image">
        <img src="{{asset('/images/post.png')}}" alt="submit" class="post-image">
      </button>
    </h1>
  </div>
</div>
<h2>機能を実装していきましょう。</h2>
<h2>投稿機能</h2>


@endsection
