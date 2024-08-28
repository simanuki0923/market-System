@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')

    <main class="contact-form__main">

        <div class="edit-profile">
            @if($user)
                <h2>プロフィール設定</h2>
                <div class="file-container">
                    <img src="{{ $user->icon_url }}" alt="{{ $user->name }}のアイコン">
                    <label for="icon" class="file-label">アイコン画像を選択</label>
                    <input type="file" id="icon" name="icon" style="display:none;">
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label>ユーザー名</label>
                    <input type="text" name="name" value="{{ $user->name }}">

                    <label>郵便番号</label>
                    <input type="text" name="postal_code" value="{{ $user->postal_code }}">

                    <label>住所</label>
                    <input type="text" name="address" value="{{ $user->address }}">

                    <label>建物名</label>
                    <input type="text" name="building" value="{{ $user->building }}">

                    <button type="submit">更新</button>
                </form>
            @else
                <p>ユーザー情報が見つかりません。</p>
            @endif
        </div>

    </main>

@endsection