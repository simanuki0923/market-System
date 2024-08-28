@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
    <main class="product-detail__main">
        <div class="product-detail__container">
            <!-- Left Half: Product Image -->
            <div class="product-detail__image">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
            </div>

            <!-- Right Half: Product Information -->
            <div class="product-detail__info">
                <h2>{{ $product->name }}</h2>
                <p class="price">価格: {{ $product->price }}円</p>
                <!-- Favorite and Comment Buttons -->
                <div class="action-buttons">
                    <button>
                        <img class="iconstar" src="{{ asset('img/星.png') }}" alt="お気に入り">
                    </button>
                    <button type="submit" onclick="window.location='{{ route('product.comments', ['id' => $product->id]) }}'">
                        <img class="iconcomment" src="{{ asset('img/吹き出し.png') }}" alt="コメントする">
                    </button>
                </div>
                <!-- Purchase Button -->
                <button class="purchase-button">購入</button>
                <p class="description">{{ $product->description }}</p>
            </div>
        </div>
    </main>
@endsection