@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
    <main class="product-list">
        <div class="container">
            <nav class="tab-buttons">
                <a href="#" id="toggleRecommended" class="tab-link">おすすめ商品</a>
                <a href="#" id="toggleMyList" class="tab-link">マイリスト</a>
            </nav>

            <section id="recommendedProducts" class="product-list__section">
                <ul class="product-list__items">
                    @foreach ($recommendedProducts as $product)
                        <li class="product-item">
                            <a href="{{ route('product', ['id' => $product->id]) }}">
                                <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('storage/img/no-image.png') }}" alt="{{ $product->name }}">
                                @if ($product->is_sold)
                                    <span class="sold-out-label">sold out</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>

            <section id="myList" class="product-list__section" style="display: none;">
                <ul class="product-list__items">
                    @foreach ($myList as $product)
                        <li class="product-item">
                            <a href="{{ $product['link'] }}">
                                <img src="{{ $product['image_url'] }}" alt="{{ $product['name'] }}">
                                @if ($product['is_sold'])
                                    <span class="sold-out-label">sold out</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </main>

    <script>
        document.getElementById('toggleRecommended').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('recommendedProducts').style.display = 'block';
            document.getElementById('myList').style.display = 'none';
        });

        document.getElementById('toggleMyList').addEventListener('click', function(e) {
            e.preventDefault();
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
                  .then(data => {
                      if (data.success) {
                          alert('商品がマイリストに追加されました');
                      } else {
                          alert('エラーが発生しました');
                      }
                  })
                  .catch(error => {
                      console.error('エラー:', error);
                      alert('エラーが発生しました');
                  });
            });
        });
    </script>
@endsection