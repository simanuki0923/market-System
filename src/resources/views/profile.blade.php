@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <main class="contact-form__main">
        <div class="edit-profile">
            @if($user)
                <h2>プロフィール設定</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="file-container">
                        <img src="{{ $user->profile && $user->profile->icon_image_path ? asset('storage/' . $user->profile->icon_image_path) : asset('img/default-icon.png') }}" alt="{{ $user->name }}のアイコン">
                        <label for="icon_image" class="file-label">アイコン画像を選択</label>
                        <input type="file" id="icon_image" name="icon_image" style="display:none;" onchange="previewImage(event);">
                    </div>                  
                    @if ($errors->has('icon_image'))
                        <div class="error">{{ $errors->first('icon_image') }}</div>
                    @endif
                    <label>ユーザー名</label>
                    <input type="text" name="name" value="{{ old('name', $user->profile->name ?? '') }}" required>
                    @if ($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                    <label>郵便番号</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $user->profile->postal_code ?? '') }}">
                    @if ($errors->has('postal_code'))
                        <div class="error">{{ $errors->first('postal_code') }}</div>
                    @endif
                    <label>住所</label>
                    <input type="text" name="address" value="{{ old('address', $user->profile->address ?? '') }}">
                    @if ($errors->has('address'))
                        <div class="error">{{ $errors->first('address') }}</div>
                    @endif
                    <label>建物名</label>
                    <input type="text" name="building" value="{{ old('building', $user->profile->building ?? '') }}">
                    @if ($errors->has('building'))
                        <div class="error">{{ $errors->first('building') }}</div>
                    @endif
                    <button type="submit">更新</button>
                </form>
            @else
                <p>ユーザー情報が見つかりません。</p>
            @endif
        </div>
    </main>
    <script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.file-container img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
    </script>
@endsection