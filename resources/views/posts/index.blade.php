@extends('layouts.login')
@section('content')

<!--ユーザーアイコンを表示-->
<!--ログインしていたら表示、その他は表示されない-->
@if(auth()->check() && auth()->user()->icon_path)
<div class="user-icon">
  <img src="{{ asset(auth()->user()->icon_path) }}" alt="User Icon">
</div>
@endif

<div class="container">
  <!-- 投稿フォーム -->
 {!! Form::open(['url' => 'post.create']) !!}
  @csrf
  <div class="form-group">
      <input type="text" name="post" placeholder="投稿内容を入力ください" class="post-text" required>
  </div>
  <button type="submit" class="btn btn-success pull-right">
    <img src="{{asset('/images/post.png')}}" alt="submit" class="post-image">
  </button>
 {!! form::close() !!}
</div>

<div>
  @foreach ($posts as $post)
  <div class="post-item">
    <p>ユーザーID:{{ $post->user_id }}</p>
    <p>投稿内容:{{ $post->post }}</p>
    <p>投稿日時:{{ $post->created_at }}</p>
    <p><a href="/posts/{{$post->id}}">Details</a></p>
  </div>
  @endforeach
</div>

@endsection
