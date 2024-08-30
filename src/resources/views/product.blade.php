@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
    <main class="product-detail__main">
        <div class="product-detail__container">
            <!-- 左側: 商品画像 -->
            <div class="product-detail__image">
                @if ($product->image_url)
                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                @else
                    <p>画像がありません</p>
                @endif
            </div>

            <!-- 右側: 商品情報 -->
            <div class="product-detail__info">
                <h2>{{ $product->name ?? '商品名がありません' }}</h2>
                <p class="price">価格: ¥{{ $product->price ? number_format($product->price) : '価格が設定されていません' }}</p>

                <!-- お気に入りとコメントボタン -->
                <div class="action-buttons">
                    <button aria-label="お気に入り" id="favorite-button" data-product-id="{{ $product->id }}" class="{{ $isFavorited ? 'favorited' : '' }}">
                        <img class="iconstar" src="{{ asset('img/星.png') }}" alt="お気に入りアイコン">
                        <span id="favorite-count">{{ $product->favorites_count ?? 0 }}</span>
                    </button>
                    <button type="button" aria-label="コメントする" onclick="window.location='{{ route('product.comments', ['id' => $product->id]) }}'">
                        <img class="iconcomment" src="{{ asset('img/吹き出し.png') }}" alt="コメントアイコン">
                    </button>
                </div>

                <!-- 購入ボタン -->
                <button class="purchase-button">購入</button>

                <!-- 商品説明 -->
                <p class="description">{{ $product->description ?? '説明がありません' }}</p>
            </div>
        </div>
    </main>

    <script>
    document.getElementById('favorite-button').addEventListener('click', function() {
    var productId = this.dataset.productId;

    fetch('/product/' + productId + '/favorite', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({})
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              // お気に入りの数を更新
              let favoriteCount = document.getElementById('favorite-count');
              if (favoriteCount) {
                  favoriteCount.textContent = data.favorites_count;
              }

              // アイコンの色を切り替える
              let favoriteButton = document.getElementById('favorite-button');
              favoriteButton.classList.toggle('favorited', data.favorited);
          }
      }).catch(error => console.error('Error:', error));
});
    </script>
@endsection