<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <a href="/">
            <img src="{{ asset('img/logo.svg') }}" alt="COACHTECHロゴ">
        </a>
        <form action="/search" method="GET">
            <input type="text" name="search" placeholder="何をお探しですか？">
        </form>
        <nav>
            @if (Auth::check())
                <a href="/mypage">マイページ</a>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="header-nav__button">ログアウト</button>
                </form>
            @else
                <a href="/login">ログイン</a>
                <a href="/register">会員登録</a>
            @endif
            <a href="{{ route('sell.show') }}" class="button">出品</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    @yield('footer')
</body>
</html>