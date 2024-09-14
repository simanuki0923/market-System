<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
</head>
<body>
    <header>
      <main class="edit-address__main">
        <h2>住所の変更</h2>
        <form action="{{ route('purchase.address.update') }}" method="POST" class="address-form">
            @csrf
                <label for="postal_code">郵便番号</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $profile->postal_code ?? '') }}" aria-required="true">
                @if ($errors->has('postal_code'))
                    <p class="error-message">{{ $errors->first('postal_code') }}</p>
                @endif
                <label for="address">住所</label>
                <input type="text" name="address" id="address" value="{{ old('address', $profile->address ?? '') }}" aria-required="true">
                @if ($errors->has('address'))
                    <p class="error-message">{{ $errors->first('address') }}</p>
                @endif
                <label for="building">建物名</label>
                <input type="text" name="building" id="building" value="{{ old('building', $profile->building ?? '') }}">
                @if ($errors->has('building'))
                    <p class="error-message">{{ $errors->first('building') }}</p>
                @endif
            <button type="submit">更新する</button>
        </form>
      </main>
    </header>
</body>
</html>
