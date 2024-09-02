@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
    <main class="edit-address__main">
    <h2>住所の変更</h2>
    <form action="{{ route('address.update') }}" method="POST" class="address-form">
        <fieldset>
            <legend>住所情報</legend>
            <label for="postal_code">郵便番号</label>
            <input type="text" name="postal_code" id="postal_code" value="{{ $user->postal_code }}" aria-required="true">

            <label for="address">住所</label>
            <input type="text" name="address" id="address" value="{{ $user->address }}" aria-required="true">

            <label for="building">建物名</label>
            <input type="text" name="building" id="building" value="{{ $user->building }}">
        </fieldset>

        <button type="submit">更新</button>
    </form>
</main>
@endsection