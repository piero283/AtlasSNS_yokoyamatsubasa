@extends('layouts.login')

@section('content')

<h1>フォロワーリストのページ</h1>
@foreach($followers as $user)
<img src="{{ asset('images/icon1.png') }}" class="post-image">
@endforeach
<div class="container">
    @if($followers->isNotEmpty())
        @foreach($followers as $user)
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
        <p>フォロワーはいません</p>
    @endif
</div>
@endsection
