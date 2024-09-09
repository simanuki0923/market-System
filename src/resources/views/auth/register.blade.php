<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <header>
        <a href="/">
            <img src="{{ asset('img/logo.svg') }}" alt="COACHTECHロゴ">
        </a>
    </header>
    <main>
        <section class="register__content">
            <h2 class="register-form__heading">会員登録</h2>

            <form class="form" action="/register" method="post">
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

                <button class="form__button-submit" type="submit">登録する</button>
            </form>

            <p class="login__link">
                <a class="login__button-submit" href="/login">ログインはこちら</a>
            </p>
        </section>
    </main>
</body>
</html>