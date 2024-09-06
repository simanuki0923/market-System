@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endsection

@section('content')
    @if($products->isNotEmpty())
        <ul class="product-list">
            @foreach($products as $product)
                <li class="product-item">
                    <a href="{{ route('product', ['id' => $product->id]) }}" class="product-link">
                        <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('storage/img/no-image.png') }}" alt="{{ $product->name }}" class="product-image">
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="no-products">該当する商品はありません。</p>
    @endif
@endsection