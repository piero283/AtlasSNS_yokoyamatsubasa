@extends('layouts.login')
@section('content')

<form action="{{ url('/profile') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <dl class="user-profile">
      <div class="user-profile-row-img">
        <img src="{{ asset('storage/profile_images/' . $user->images) }}" class="post-image edit-img">
        <dt>ユーザー名</dt>
        <dd><input type="text" name="username" value="{{ $user -> username }}"></dd>
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
    <div class="user-profile-row">
      <dt>メールアドレス</dt>
      <dd><input type="email" name="mail" value="{{ $user -> mail }}"></dd>
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
    <div class="user-profile-row">
      <dt>パスワード</dt>
      <dd><input type="password" name="password"></dd>
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
    <div class="user-profile-row">
      <dt>パスワード確認</dt>
      <dd><input type="password" name="password_confirmation"></dd>
    </div>
    <div class="user-profile-row">
      <dt>自己紹介</dt>
      <dd><input type="text" name="bio" value="{{ $user -> bio }}"></dd>
          @if($errors->has('bio'))
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->get('bio') as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
    </div>
    <div class="user-profile-row edit">
      <dt>アイコン画像</dt>
      <dd><input type="file" name="images" class="img-edit"></dd>
          @if($errors->has('images'))
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->get('images') as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
    </div>
  </dl>
  <input type="submit" name="profile-update" value="更新" class="profile-update">
</form>

@endsection
