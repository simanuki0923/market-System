@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
    <main class="sell-form__main">
        <h2>商品の出品</h2>
        <form action="/sell" method="POST" enctype="multipart/form-data" class="sell-form">
            @csrf

            <fieldset class="sell-form__fieldset">
    <legend class="sell-form__legend">商品画像</legend>
    <input type="file" id="image" name="image" class="sell-form__input" aria-label="商品画像を選択">
    <div class="sell-form__file-wrapper">
        <label for="image" class="sell-form__file-label">画像を選択</label>
    </div>
</fieldset>

            <fieldset class="sell-form__fieldset">
                <legend class="sell-form__legend">商品の詳細</legend>
                <label for="category" class="sell-form__label">カテゴリー</label>
                <input type="text" name="category" id="category" class="sell-form__input" aria-required="true">

                <label for="condition" class="sell-form__label">商品の状態</label>
                <input type="text" name="condition" id="condition" class="sell-form__input" aria-required="true">
            </fieldset>

            <fieldset class="sell-form__fieldset">
                <legend class="sell-form__legend">商品名と説明</legend>
                <label for="name" class="sell-form__label">商品名</label>
                <input type="text" name="name" id="name" class="sell-form__input" aria-required="true">

                <label for="description" class="sell-form__label">商品の説明</label>
                <textarea name="description" id="description" class="sell-form__textarea" aria-required="true"></textarea>
            </fieldset>

            <fieldset class="sell-form__fieldset">
                <legend class="sell-form__legend">販売価格</legend>
                <label for="price" class="sell-form__label">販売価格</label>
                <input type="text" name="price" id="price" class="sell-form__input" aria-required="true" placeholder="￥">
            </fieldset>

            <button type="submit" class="sell-form__button">出品する</button>
        </form>
    </main>
@endsection