@extends('layouts.login')

@section('content')

<div class="container">
    <div class="profile">
        <img src="{{ asset('images/icon1.png') }}" class="post-image">
        <p>ユーザー名</p>
        <p>{{ $user->username }}</p>
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
