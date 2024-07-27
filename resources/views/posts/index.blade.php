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
  {!! Form::open(['url' => 'post/create']) !!}
  @csrf
  <div class="form-group">
      <input type="text" name="post" placeholder="投稿内容を入力ください" class="post-text" required>
  </div>
  <button type="submit" class="btn btn-success pull-right">
    <img src="{{asset('/images/post.png')}}" alt="submit" class="post-image">
  </button>
  {!! form::close() !!}
</div>

@foreach ($posts as $post)
<div class="post-item">
  <p>ユーザーID:{{ $post->user_id }}</p>
  <p>投稿内容:{{ $post->post }}</p>
  <p>投稿日時:{{ $post->created_at }}</p>
  <!--モーダル開くeditボタン-->
  <button class="modal-open js-modal-open" data-post-id="{{ $post->id }}" data-post-content="{{ $post->post }}">
    <img src="{{asset('images/edit.png')}}" class="post-image">
  </button>
  {!! Form::open(['url' => 'post/delete']) !!}
  @csrf
  <input type="hidden" name="id" value="{{ $post->id }}">
  <button class="delete-button" onclick="return confirm('本当に削除しますか？');">
    <img src="{{asset('images/trash.png')}}" class="post-image">
  </button>
  {!! Form::close() !!}
</div>
  <!--モーダル本体-->
      <div class="modal js-modal">
        <div class="modal-container">
          <div class="modal-close js-modal-close">x</div>
          <div class="modal-content">
            {!! Form::open(['url' => 'post/update']) !!}
            @csrf
            <input type="hidden" name="id" value="{{ $post->id }}">
            <div class="form-group">
                <textarea name="post" class="form-control">{{ $post->post }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><img src="{{asset('images/edit.png')}}" class="post-image"></button>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
@endforeach

  @endsection
