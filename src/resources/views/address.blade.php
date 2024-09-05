@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
    <main class="edit-address__main">
        <h2>住所の変更</h2>
        <form action="{{ route('purchase.address.update') }}" method="POST" class="address-form">
            @csrf
                <label for="postal_code">郵便番号</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ $profile->postal_code ?? '' }}" aria-required="true">

                <label for="address">住所</label>
                <input type="text" name="address" id="address" value="{{ $profile->address ?? '' }}" aria-required="true">

                <label for="building">建物名</label>
                <input type="text" name="building" id="building" value="{{ $profile->building ?? '' }}">
            <button type="submit">更新する</button>
        </form>
    </main>
@endsection