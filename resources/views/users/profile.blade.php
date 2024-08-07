@extends('layouts.login')

@section('content')

<div class="container">
    <div class="profile">
        <img src="{{ asset('images/icon1.png') }}" class="post-image">
        <p>ユーザー名</p>
        <p>{{ $user->username }}</p>
        <P>{{ $user->bio }}</P>
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
        @if($user->posts->isNotEmpty())
            @foreach($user->posts as $post)
                <div class="post-item">
                    <p>{{ $post->post }}</p>
                    <p>{{ $post->created_at }}</p>
                </div>
            @endforeach
        @else
            <p>投稿はありません</p>
        @endif
    </div>
</div>
@endsection
