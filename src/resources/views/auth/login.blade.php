<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header>
        <a href="/">
            <img src="{{ asset('img/logo.svg') }}" alt="COACHTECHロゴ">
        </a>
    </header>
    <main>
        <section class="login__content">
            <h2 class="login-form__heading">ログイン</h2>

            <form class="form" action="/login" method="post">
                @csrf

                <label class="form__group">
                    <span class="form__label--item">メールアドレス</span>
                    <input type="email" name="email" value="{{ old('email') }}" />
                    @error('email')
                    <span class="form__error">{{ $message }}</span>
                    @enderror
                </label>

                <label class="form__group">
                    <span class="form__label--item">パスワード</span>
                    <input type="password" name="password" />
                    @error('password')
                    <span class="form__error">{{ $message }}</span>
                    @enderror
                </label>

                <button class="form__button-submit" type="submit">ログイン</button>
            </form>

            <p class="register__link">
                <a class="register__button-submit" href="/register">会員登録はこちら</a>
            </p>
        </section>
    </main>
</body>
</html>