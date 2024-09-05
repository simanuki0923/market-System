<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>決済完了</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/done.css') }}">
</head>
<body>
<div class="container">
    <h1>決済が完了しました！</h1>
    <a href="{{ route('product.list') }}" class="btn btn-primary">ホームに戻る</a>
</div>
</body>
</html>