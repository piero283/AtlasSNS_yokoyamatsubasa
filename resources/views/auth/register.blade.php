@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<!-- バリデーションチェックのエラーメッセージを表示させるコード -->
@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<section class="register-section">
  <h1 class="form-tittle">新規ユーザー登録</h1>

  <div class="form-group">
    {{ Form::label('ユーザー名') }}
    {{ Form::text('username',null,['class' => 'input']) }}
  </div>

  <div class="form-group">
  {{ Form::label('メールアドレス') }}
  {{ Form::text('mail',null,['class' => 'input']) }}
  </div>

  <div class="form-group">
  {{ Form::label('パスワード') }}
  {{ Form::password('password',['class' => 'input']) }}
  </div>

  <div class="form-group">
  {{ Form::label('パスワード確認') }}
  {{ Form::password('password_confirmation',['class' => 'input']) }}
  </div>

  <div class="form-btn">
  {{ Form::submit('新規登録', ['class' => 'submit-button']) }}
  </div>

  <p class="link-a"><a href="/login" class="link">ログイン画面へ戻る</a></p>

  {!! Form::close() !!}
</section>
@endsection
