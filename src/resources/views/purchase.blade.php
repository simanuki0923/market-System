@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
    <main class="purchase-form__main">
        <div class="purchase-container">
            <!-- 左側: 商品画像、商品名、価格、支払い方法、配送先 -->
            <div class="left-section">
                <div class="product-info">
                    <div class="product-image">
                        <img src="{{ asset($mockData['product_image']) }}" alt="Product Image">
                    </div>
                    <div class="product-details">
                        <h2>{{ $mockData['product_name'] }}</h2>
                        <p>価格: {{ $mockData['price'] }}</p>
                    </div>
                </div>

                <div class="payment-shipping-info">
                    <div class="info-item">
                        <div class="info-label">支払い方法</div>
                        <a href="#" class="change-link">変更する</a>
                    </div>

                    <div class="info-item">
                        <div class="info-label">配送先</div>
                        <a href="#" class="change-link">変更する</a>
                    </div>
                </div>
            </div>

            <!-- 右側: 購入情報 -->
            <div class="right-section">
                <div class="price-info">
                    <p>商品代金: {{ $mockData['total_amount'] }}</p>
                    <p>支払い金額: {{ $mockData['total_amount'] }}</p>
                    <p>支払い方法: {{ $mockData['payment_method'] }}</p>
                </div>

                <div class="purchase-button">
                    <button type="button">購入</button>
                </div>
            </div>
        </div>
    </main>
@endsection