@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
    <main class="sell-form__main">
    <h2>商品の出品</h2>
    <form action="/sell" method="POST" enctype="multipart/form-data" class="sell-form">
        <fieldset>
            <legend>商品画像</legend>
            <input type="file" name="image" aria-label="商品画像を選択">
        </fieldset>

        <fieldset>
            <legend>商品の詳細</legend>
            <label for="category">カテゴリー</label>
            <select name="category" id="category">
                <!-- カテゴリー選択肢 -->
            </select>

            <label for="condition">商品の状態</label>
            <select name="condition" id="condition">
                <!-- 状態選択肢 -->
            </select>
        </fieldset>

        <fieldset>
            <legend>商品名と説明</legend>
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" aria-required="true">

            <label for="description">商品の説明</label>
            <textarea name="description" id="description" aria-required="true"></textarea>
        </fieldset>

        <fieldset>
            <legend>販売価格</legend>
            <label for="price">販売価格</label>
            <input type="text" name="price" id="price" aria-required="true">
        </fieldset>

        <button type="submit">出品</button>
    </form>
</main>
@endsection