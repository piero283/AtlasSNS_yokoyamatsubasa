@extends('layouts.login')

@section('content')

<h1>フォローリスト</h1>
@foreach($followedUsers as $user)
<img src="{{ asset('images/icon1.png') }}" class="post-image">
@endforeach
<div class="container">
    @if($followedUsers->isNotEmpty())
        @foreach($followedUsers as $user)
            <div class="user">
                <h2>{{ $user->username }}</h2>
                <a href="{{ route('users.profile', ['user' => $user->id]) }}">
                  <img src="{{ asset('images/icon1.png') }}" class="post-image">
                </a>
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
        @endforeach
    @else
        <p>フォローしているユーザーはいません</p>
    @endif
</div>

@endsection
