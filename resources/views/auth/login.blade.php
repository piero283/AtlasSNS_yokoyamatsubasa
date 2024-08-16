@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login', 'class' => 'login-form']) !!}

<section class="login-section">
    <h1 class="form-tittle">AtlasSNSへようこそ</h1>

    <div class="form-group">
        {{ Form::label('メールアドレス') }}
        {{ Form::text('mail',null,['class' => 'input']) }}
    </div>

    <div class="form-group">
        {{ Form::label('パスワード') }}
        {{ Form::password('password',['class' => 'input']) }}
    </div>

    <div class="form-btn">
        {{ Form::submit('ログイン', ['class' => 'submit-button']) }}
    </div>

    <p class="link-a"><a href="/register" class="link">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}
</section>
@endsection
