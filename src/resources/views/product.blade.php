@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
    <main class="product-detail__main">
        <div class="product-detail__container">
            <!-- 左側: 商品画像 -->
            <div class="product-detail__image">
                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
            </div>

            <!-- 右側: 商品情報 -->
            <div class="product-detail__info">
                <h2>{{ $product->name }}</h2>
                <p class="price">価格: ¥{{ number_format($product->price) }}</p>

                <!-- お気に入りとコメントボタン -->
                <div class="action-buttons">
                    <button aria-label="お気に入り">
                        <img class="iconstar" src="{{ asset('img/星.png') }}" alt="お気に入りアイコン">
                    </button>
                    <button type="button" aria-label="コメントする" onclick="window.location='{{ route('product.comments', ['id' => $product->id]) }}'">
                        <img class="iconcomment" src="{{ asset('img/吹き出し.png') }}" alt="コメントアイコン">
                    </button>
                </div>

                <!-- 購入ボタン -->
                <button class="purchase-button">購入</button>

                <!-- 商品説明 -->
                <p class="description">{{ $product->description }}</p>
            </div>
        </div>
    </main>
@endsection