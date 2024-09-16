@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
   <main class="product-detail__main container">
    <article class="product-detail__container">
        <figure class="product-detail__image">
            @if ($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
            @else
                <figcaption>画像がありません</figcaption>
            @endif
        </figure>

        <section class="product-detail__info">
            <h2>{{ $product->name ?? '商品名がありません' }}</h2>
            <p class="brand">ブランド: {{ $product->brand ?? 'ブランド情報がありません' }}</p>
            <p class="price">¥{{ $product->price ? number_format($product->price) : '価格が設定されていません' }}(値段)</p>
            
            <aside class="action-buttons">
                <button aria-label="お気に入り" id="favorite-button" data-product-id="{{ $product->id }}" class="{{ $isFavorited ? 'favorited' : '' }}">
                    <img class="iconstar" src="{{ asset('img/star.jpg') }}" alt="お気に入りアイコン">
                    <span id="favorite-count">{{ $product->favorites_count ?? 0 }}</span>
                </button>
                <button type="button" aria-label="コメントする" onclick="window.location='{{ route('product.comments', ['id' => $product->id]) }}'">
                    <img class="iconcomment" src="{{ asset('img/comment.jpg') }}" alt="コメントアイコン">
                    <span id="comment-count">{{ $product->comments_count ?? 0 }}</span>
                </button>
            </aside>

            <button class="purchase-button" onclick="window.location='{{ route('purchase', ['product_id' => $product->id]) }}'">
            購入
            </button>
            
            <div class="product-info-item">
                <strong>商品説明:</strong>
                <p class="description">{{ $product->description ?? '説明がありません' }}</p>
            </div>
      
            <p class="category">カテゴリ: {{ $product->category->name ?? 'カテゴリが設定されていません' }}</p>
            <p class="condition">状態: {{ $product->condition ?? '状態情報がありません' }}</p>
        </section>
    </article>
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
                  let favoriteCount = document.getElementById('favorite-count');
                  if (favoriteCount) {
                      favoriteCount.textContent = data.favorites_count;
                  }

                  let favoriteButton = document.getElementById('favorite-button');
                  favoriteButton.classList.toggle('favorited', data.favorited);
              } else {
                  console.error('Failed to favorite the product.');
              }
          }).catch(error => console.error('Error:', error));
    });
    </script>
@endsection