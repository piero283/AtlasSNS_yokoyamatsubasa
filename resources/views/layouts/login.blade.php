<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->

</head>
    <body>
        <header>
            <div id="header-wrap">
                <div id="head-logo">
                    <a href="{{URL::to('/top')}}">
                    <img src="{{asset('/images/atlas.png')}}">
                    </a>
                </div>
                <div id="user">
                    <p class="user-name">{{ Auth::user()->username ??'ゲスト' }} さん</p>
                    <!--アコーディオンメニュー-->
                    <nav class="menu_outer">
                        <div class="menu_index toggle_btn">
                        </div>
                        <ul class="menu_container">
                        <li><a href="{{ url('/top') }}">ホーム</a></li>
                        <li><a href="{{ url('/profile') }}">プロフィール</a></li>
                        <li><a href="{{ url('/logout') }}">ログアウト</a></li>
                        </ul>
                    </nav>
                    <script>
                        //menuタイトルの要素を取得
                        const menuIndex = document.querySelector(".menu_index");
                        //トグルスイッチの要素を取得
                        const toggleBtn = document.querySelector(".toggle_btn");
                        //メニューリストの要求を取得
                        const menuContainer = document.querySelector(".menu_container");
                        //メニューリストの縦幅を取得
                        const listHeight = menuContainer.
                        clientHeight + 1;
                        menuContainer.style.transform =
                        `translateY(-${listHeight}px)`;
                        //menuの要素がクリックされたら
                        menuIndex.addEventListener
                        ("click", () => {

                            //透明にしていたリストを表示させる
                            menuContainer.style.opacity = 1;

                            toggleBtn.classList.toggle
                            ("active");

                            if(!menuContainer.classList.
                            contains("active")){
                                menuContainer.classList.
                                add("active");
                                menuContainer.style.
                                transform = "translateY(0px)";
                            } else {
                                menuContainer.classList.
                                remove("active");
                                menuContainer.style.
                                transform = `translateY(-${listHeight}px)`;
                            }
                        });
                    </script>
                    <div class="icon"><img src="{{ asset('storage/profile_images/' . $user->images) }}" class="icon1-image"></div>
                </div>
            </div>
        </header>
        <section id="row">
            <section id="container">
                @yield('content')
            </section>
            <section id="side-bar">
                <div class="confirm">
                    <p class="side-name">{{ Auth::user()->username ?? 'ゲスト' }} さんの</p>
                    <div class="side-follow">
                    <p>フォロー数</p>
                    <p>{{ $follow_count }} 人</p>
                    </div>
                    <p class="side-btn-over">
                        <a href="/followList" class="side-btn btn-follow">フォローリスト</a>
                    </p>
                    <div class="side-followed">
                    <p>フォロワー数</p>
                    <p>{{ $follower_count }} 人</p>
                    </div>
                    <p class="side-btn-over">
                        <a href="/followerList" class="side-btn btn-followed">フォロワーリスト</a>
                    </p>
                </div>
                <p class="side-btn-over-search"><a href="/search" class="side-btn btn-search">ユーザー検索</a></p>
            </section>
        </section>
        <footer>
        </footer>
        <script src="{{ asset('js/script.js')}}"></script>
    </body>
    </html>
