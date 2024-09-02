@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
    <main class="purchase-form__main">
    <div class="purchase-container">
        <section class="product-info">
            <figure class="product-image">
                <img src="{{ asset($mockData['product_image']) }}" alt="Product Image">
            </figure>
            <div class="product-details">
                <h2>{{ $mockData['product_name'] }}</h2>
                <p>価格: {{ $mockData['price'] }}</p>
            </div>
        </section>

        <section class="payment-shipping-info">
            <div class="info-item">
                <div class="info-label">支払い方法</div>
                <a href="#" class="change-link">変更する</a>
            </div>
            <div class="info-item">
                <div class="info-label">配送先</div>
                <a href="#" class="change-link">変更する</a>
            </div>
        </section>
        <button type="submit" class="purchase-button">購入を確定する</button>
    </div>
</main>
@endsection