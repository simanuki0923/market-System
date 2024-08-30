@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
    <main class="product-list">
        <div class="container">
            <div class="tab-buttons">
                <button id="toggleRecommended">おすすめ商品</button>
                <button id="toggleMyList">マイリスト</button>
            </div>
            <!-- おすすめ商品 -->
            <div id="recommendedProducts" class="product-list__section">
                <div class="product-list__items">
                    @foreach ($recommendedProducts as $product)
                        <div class="product-item">
                            <a href="{{ route('product', ['id' => $product->id]) }}">
                                <img src="{{ $product->image_url ? asset($product->image_url) : asset('img/no-image.png') }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- マイリスト -->
            <div id="myList" class="product-list__section" style="display: none;">
                <div class="product-list__items">
                    @foreach ($myList as $product)
                        <div class="product-item">
                            <a href="{{ $product['link'] }}">
                                <img src="{{ $product['image_url'] ? asset($product['image_url']) : asset('img/no-image.png') }}" alt="{{ $product['name'] }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </main>

    <script>
        document.getElementById('toggleRecommended').addEventListener('click', function() {
            document.getElementById('recommendedProducts').style.display = 'block';
            document.getElementById('myList').style.display = 'none';
        });

        document.getElementById('toggleMyList').addEventListener('click', function() {
            document.getElementById('recommendedProducts').style.display = 'none';
            document.getElementById('myList').style.display = 'block';
        });

        document.querySelectorAll('.favorite-button').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.dataset.productId;

                fetch('/product/' + productId + '/favorite', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({})
                }).then(response => response.json())
            });
        });
    </script>
@endsection