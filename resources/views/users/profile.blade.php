@extends('layouts.login')

@section('content')

<div class="container">
    <div class="other-profile">
        <div class="other-profile-name">
            @if ($user->images === 'icon1.png')
            <img src="{{ asset('images/' . $user->images) }}" class="list-img">
            @else
            <img src="{{ asset('storage/profile_images/' . $user->images) }}" class="list-img">
            @endif
            <p class="other-text">ユ-ザ-名</p>
            <p>{{ $user->username }}</p>
        </div>
        <div class="other-profile-bio">
            <p class="other-text">自己紹介</p>
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
        </div>
    </div>
    <div class="other-tweet">
        @if ($user->images === 'icon1.png')
        <img src="{{ asset('images/' . $user->images) }}" class="list-img">
        @else
        <img src="{{ asset('storage/profile_images/' . $user->images) }}" class="list-img">
        @endif

        @if($user->posts->isNotEmpty())
        @foreach($user->posts as $post)
            <div class="other-tweet-row">
                <div class="other-tweet-info">
                    <p class="other-tweet-name">{{ $user->username }}</p>
                    <p class="other-tweet-text">{{ $post->post }}</p>
                </div>
                <div class="other-tweet-meta">
                    <p class="other-tweet-time">{{ $post->created_at }}</p>
                </div>
            </div>
        @endforeach
        @else
            <p>投稿はありません</p>
        @endif
    </div>
</div>
@endsection
