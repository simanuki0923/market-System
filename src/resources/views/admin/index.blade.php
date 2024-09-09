<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
</head>
<body>
  <main>
        <h1>管理ダッシュボード</h1>
    <div class="btn-container">
        <a href="{{ route('admin.showUsers') }}" class="btn btn-primary">ユーザー削除</a>
        <a href="{{ route('admin.showComments') }}" class="btn btn-secondary">コメント管理</a>
        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">ログアウト</button>
        </form>
    </div>
  </main>
</body>
</html>