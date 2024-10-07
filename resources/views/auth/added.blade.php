@extends('layouts.logout')

@section('content')


<section class="added-section">
  <div class="welcome">
    <p>{{ $user->username }}さん</p>
    <p>ようこそ! AtlasSNSへ</p>
  </div>
  <div class="text">
    <p>ユーザー登録が完了いたしました。</p>
    <p>早速ログインをしてみましょう。</p>
  </div>
  <div class="form-btn">
      <p class="link-a"><a href="/login" class="submit-button link">ログイン画面へ</a></p>
  </div>
</section>
@endsection
