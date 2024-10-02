@extends('layouts.login')
@section('content')

<!--ユーザーアイコンを表示-->
<!--ログインしていたら表示、その他は表示されない-->
@if(auth()->check() && auth()->user()->icon_path)
<div class="user-icon">
  <img src="{{ asset(auth()->user()->icon_path) }}" alt="User Icon">
</div>
@endif

<div class="tweet-container">
  <!-- 投稿フォーム -->
  {!! Form::open(['url' => 'post/create']) !!}
  @csrf
  <div class="form-group">
      <img src="{{ asset('storage/profile_images/' . $user->images) }}" class="tweet-icon">
      <input type="text" name="post" placeholder="投稿内容を入力ください" class="post-text" required>
  </div>
  <button type="submit" class="pull-right">
    <img src="{{asset('/images/post.png')}}" alt="submit" class="tweet-btn">
  </button>
  </div>
  {!! form::close() !!}

@foreach ($posts as $post)
<div class="tweet-block">
    @if ($post->user->images === 'icon1.png')
      <!-- $post->user->imageがicon1.pngの場合 -->
      <img src="{{ asset('images/' . $post->user->images) }}" class="user-icon">
    @else
      <!-- それ以外の場合 -->
      <img src="{{ asset('storage/profile_images/' . $post->user->images) }}" class="user-icon">
    @endif
  <div class="tweet-sub-block">
    <div class="tweet-info">
      <p class="tweet-name">{{ $post->user->username }}</p>
      <p class="tweet-text">{{ $post->post }}</p>
    </div>
    <div class="tweet-meta">
      <p class="tweet-time">{{ $post->created_at }}</p>
      <!--ログインユーザーのみボタン表示-->
      @if (Auth::id() === $post->user_id) <!-- 現在のログインユーザーと投稿者が一致する場合のみ表示 -->
        <div class="tweet-action">
          <button class="modal-open js-modal-open" data-post-id="{{ $post->id }}" data-post-content="{{ $post->post }}">
            <img src="{{ asset('images/edit.png') }}" class="tweet-image">
          </button>
          {!! Form::open(['url' => 'post/delete']) !!}
          @csrf
          <input type="hidden" name="id" value="{{ $post->id }}">
          <button class="delete-button" onclick="return confirm('本当に削除しますか？');">
            <img src="{{ asset('images/trash.png') }}" class="tweet-image">
          </button>
          {!! Form::close() !!}
        </div>
      @endif
    </div>
  </div>
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
