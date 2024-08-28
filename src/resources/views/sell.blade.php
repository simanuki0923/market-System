@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
    <main class="contact-form__main">
        <h2>商品の出品</h2>
       <div class="sell-page">
    <form action="/sell" method="POST" enctype="multipart/form-data">
        <label>商品画像</label>
        <input type="file" name="image">
        
        <h3>商品の詳細</h3>
        <label>カテゴリー</label>
        <select name="category">
            <!-- カテゴリー選択肢 -->
        </select>
        
        <label>商品の状態</label>
        <select name="condition">
            <!-- 状態選択肢 -->
        </select>

        <h3>商品名と説明</h3>
        <label>商品名</label>
        <input type="text" name="name">
        
        <label>商品の説明</label>
        <textarea name="description"></textarea>
        
        
        <h3>販売価格</h3>
        <label>販売価格</label>
        <input type="text" name="price">
        
        <button type="submit">出品</button>
    </form>
</div> 
    </main>
@endsection