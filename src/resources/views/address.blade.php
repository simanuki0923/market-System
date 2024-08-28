@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
    <main class="contact-form__main">
       <div class="edit-address">
        <h2>住所の変更</h2>
    <form action="{{ route('address.update') }}" method="POST">
        <label>郵便番号</label>
        <input type="text" name="postal_code" value="{{ $user->postal_code }}">
        
        <label>住所</label>
        <input type="text" name="address" value="{{ $user->address }}">
        
        <label>建物名</label>
        <input type="text" name="building" value="{{ $user->building }}">
        
        <button type="submit">更新</button>
    </form>
</div> 
    </main>
@endsection