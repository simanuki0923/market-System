<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/mail.css') }}">
</head>
<body>
    <header>
        <h2 class="page-title">お知らせメール</h2>
        <a href="{{ route('admin.index') }}" class="back-button">戻る</a>
    </header>
    @if (session('success'))
        <section class="alert alert-success">
            {{ session('success') }}
        </section>
    @endif
    <main>
        <form action="{{ route('admin.sendMail') }}" method="POST" class="email-form">
            @csrf
            <div class="form-group">
                <label for="recipient_email" class="form-label">宛先</label>
                <input type="email" id="recipient_email" name="recipient_email" class="form-input" value="{{ old('recipient_email') }}" required>
                @error('recipient_email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="subject" class="form-label">件名</label>
                <input type="text" id="subject" name="subject" class="form-input" value="{{ old('subject') }}" required>
                @error('subject')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="message" class="form-label">メッセージ</label>
                <textarea id="message" name="message" class="form-textarea" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-button">送信</button>
        </form>
    </main>
</body>
</html>