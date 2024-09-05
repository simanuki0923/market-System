@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
    <main class="purchase-form__main">
        <div class="left-side">
            <section class="product-info">
                <figure class="product-image">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                </figure>
                <div class="product-details">
                    <h2>{{ $product->name }}</h2>
                    <p>価格: ¥{{ number_format($product->price) }}</p>
                </div>
            </section>

            <section class="payment-shipping-info">
                <div class="info-item">
                    <div class="info-label">支払い方法</div>
                    <a href="#" class="change-link">変更する</a>
                </div>
                <div class="info-item">
                    <div class="info-label">配送先</div>
                    <a href="{{ route('purchase.address.edit') }}" class="change-link">変更する</a>
                </div>
            </section>
        </div>

        <div class="right-side">
            <section class="price-info">
                <div class="info-item">
                    <div class="info-label">商品代金</div>
                    <p>¥{{ number_format($product->price) }}</p>
                </div>
                <div class="info-item">
                    <div class="info-label">支払い金額</div>
                    <p>¥{{ number_format($product->price) }}</p>
                </div>
                <div class="info-item">
                    <div class="info-label">支払い方法</div>
                    <p>クレジットカード</p> <!-- Adjust this to reflect the actual payment method -->
                </div>
            </section>
            <form action="{{ route('payment.create') }}" method="GET">
            <button type="submit" class="purchase-button">購入を確定する</button>
        </div>
    </main>
@endsection