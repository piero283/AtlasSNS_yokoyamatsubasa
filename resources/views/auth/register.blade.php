@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}


<section class="register-section">
  <h1 class="form-tittle">新規ユーザー登録</h1>

  <div class="form-group">
    {{ Form::label('ユーザー名') }}
    {{ Form::text('username',null,['class' => 'input']) }}
      @if($errors->has('username'))
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->get('username') as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
  </div>

  <div class="form-group">
  {{ Form::label('メールアドレス') }}
  {{ Form::text('mail',null,['class' => 'input']) }}
  @if($errors->has('mail'))
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->get('mail') as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  </div>

  <div class="form-group">
  {{ Form::label('パスワード') }}
  {{ Form::password('password',['class' => 'input']) }}

  @if($errors->has('password'))
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->get('password') as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
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
