@extends('layouts.login')

@section('content')




<!--検索フォーム-->
<div class="search-block">
  <form action="{{ route('users.search') }}" method="GET">
    @csrf
    <input type="text" name="query" placeholder="ユーザー名" value="{{ request('query') }}">
    <button type="submit" class="btn btn-success pull-right">
      <img src="{{ asset('/images/search.png') }}" alt="submit" class="post-image">
    </button>
  </form>
  <div class="search-answer">
    @if(isset($query) && $query !== '')
    <P>検索ワード: {{ $query }}</P>
    @endif

    @if(isset($users) && $users->isNotEmpty())
      <ul>
        @foreach($users as $user)
          <li>{{ $user->name }}</li>
        @endforeach
      </ul>
    @else
      <p>ユーザーが見つかりませんでした。</p>
    @endif
  </div>
</div>

<div class="user-list">
  @foreach ($users as $user)
  <div class="list-item">
    @if ($user->images === 'icon1.png')
      <!-- $post->user->imageがicon1.pngの場合 -->
      <img src="{{ asset('images/' . $user->images) }}" class="list-img">
    @else
      <!-- それ以外の場合 -->
      <img src="{{ asset('storage/profile_images/' . $user->images) }}" class="list-img">
    @endif
    <p class="list-name">{{ $user->username }}</p>
    <!--フォロー機能-->
    @if (auth()->user()->isFollowing($user->id))
    <form action="{{ route('unfollow') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="followed_id" value="{{ $user -> id}}">
        <button type="submit" class="btn btn-danger">フォロー解除</button>
    </form>
    @else
    <form action="{{ route('follow') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="followed_id" value="{{ $user -> id}}">
        <button type="submit" class="btn btn-primary">フォローする</button>
    </form>
    @endif
  </div>
  @endforeach
</div>

@endsection
