<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/comment.css') }}">
</head>
<body>
    <header>
        <h2>コメント管理</h2>
        <a href="{{ route('admin.index') }}" class="back-button">戻る</a>
    </header>

    @if (session('success'))
        <section class="alert alert-success">
            {{ session('success') }}
        </section>
    @endif

    <main class="table-wrapper">
        <table class="comments-table">
            <thead>
                <tr>
                    <th>ユーザー名</th>
                    <th>コメント内容</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->user->name ?? '不明' }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>
                            <form action="{{ route('admin.deleteComment', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button" onclick="return confirm('コメントを削除してもよろしいですか？');">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>