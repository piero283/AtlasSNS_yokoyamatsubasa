@extends('layouts.login')

@section('content')

<div class="follow-list">
    <h1>フォロワーリスト</h1>
    <div class="list-icon">
            @foreach($followers as $user)
            @if ($user->images === 'icon1.png')
                <img src="{{ asset('images/icon1.png') }}" class="user-icon">
            @else
                <img src="{{ asset('storage/profile_images/' . $user->images) }}" class="user-icon">
            @endif
            @endforeach
    </div>
</div>

<div class="container">
    @if($followers->isNotEmpty())
        @foreach($followers as $user)
            <div class="tweet-block">

                <a href="{{ route('users.profile', ['user' => $user->id]) }}">
                    @if ($user->images === 'icon1.png')
                        <img src="{{ asset('images/icon1.png') }}" class="user-icon">
                    @else
                        <img src="{{ asset('storage/profile_images/' . $user->images) }}" class="user-icon">
                    @endif
                </a>
                @if($user->posts->isNotEmpty())
                    @foreach($user->posts as $post)
                    <div class="tweet-sub-block">
                        <div class="tweet-info">
                            <p class="tweet-name">{{ $user->username }}</p>
                            <p class="tweet-text">{{ $post->post }}</p>
                        </div>
                        <div class="tweet-meta">
                            <p class="tweet-time">{{ $post->created_at }}</p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="tweet-text">投稿はありません</p>
                @endif
            </div>
        @endforeach
    @else
        <p>フォロワーはいません</p>
    @endif
</div>
@endsection
