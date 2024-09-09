<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/delete.css') }}">
</head>
<body>
    <main class="main-content">
        <header>
            <h1 class="page-title">ユーザー一覧</h1>
            <div class="button-container">
                <a href="{{ route('admin.index') }}" class="back-link">戻る</a>
            </div>
        </header>

        @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        <section class="user-list-section">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>メールアドレス</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('本当に削除しますか？')">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>