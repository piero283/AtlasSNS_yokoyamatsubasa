@extends('layouts.login')

@section('content')

<!--検索フォーム-->
<div class="container">
  <form action="{{ route('users.search') }}" method="GET">
    @csrf
    <input type="text" name="query" placeholder="ユーザー名" value="{{ request('query') }}">
    <button type="submit" class="btn btn-success pull-right">
      <img src="{{ asset('/images/search.png') }}" alt="submit" class="post-image">
    </button>
  </form>

  @foreach ($users as $user)
  <div class="">
  <img src="{{ asset('images/icon1.png') }}" class="post-image">
  <p>{{ $user->username }}</p>
  
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
  @endforeach

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

@endsection
