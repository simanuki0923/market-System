@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('content')
    <main class="product-detail">
        <div class="product-detail__container">
            <!-- Left Half: Product Image -->
            <section class="product-detail__image">
                <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('storage/img/no-image.png') }}" alt="{{ $product->name }}">
            </section>

            <!-- Right Half: Product Information -->
            <section class="product-detail__info">
                <h2>{{ $product->name ?? '商品名がありません' }}</h2>
                <p class="brand">ブランド: {{ $product->brand ?? 'ブランド情報がありません' }}</p>
                <p class="price">¥{{ $product->price ? number_format($product->price) : '価格が設定されていません' }}(値段)</p>

                <!-- Favorite and Comment Buttons -->
                <div class="product-detail__actions">
                    <button class="favorite-button {{ $isFavorited ? 'favorited' : '' }}" data-product-id="{{ $product->id }}">
                        <img class="iconstar" src="{{ asset('img/star.jpg') }}" alt="お気に入り">
                        <span class="favorite-count">{{ $product->favorites_count }}</span>
                    </button>
                    <button type="button" onclick="window.location='{{ route('product.comments', ['id' => $product->id]) }}'">
                        <img class="iconcomment" src="{{ asset('img/comment.jpg') }}" alt="コメントする">
                        <span class="comment-count">{{ $product->comments_count }}</span>
                    </button>
                </div>

                <!-- Display Comments -->
                <section class="product-detail__comments">
                    @if(isset($comments) && $comments->isNotEmpty())
                        @foreach($comments as $comment)
                            <article class="comment">
                                <div class="comment__header">
                                    <!-- Display user icon -->
                                    <img src="{{ $comment->user->profile && $comment->user->profile->icon_image_path 
                                        ? asset('storage/' . $comment->user->profile->icon_image_path) 
                                        : asset('img/sample.jpg') }}" 
                                        alt="{{ $comment->user->profile->name ?? $comment->user->name }}" 
                                        class="comment__user-icon">
                                    <strong>{{ $comment->user->profile->name ?? $comment->user->name }}</strong>
                                </div>
                                <p>{{ $comment->comment_text }}</p>
                                @if(auth()->check() && auth()->id() == $comment->user_id)
                                    <!-- Delete button -->
                                    <form action="{{ route('product.destroyComment', ['productId' => $product->id, 'commentId' => $comment->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">削除</button>
                                    </form>
                                @endif
                            </article>
                        @endforeach
                    @else
                        <p>コメントはまだありません。</p>
                    @endif
                </section>

                <!-- Comment Form -->
                <section class="product-detail__comment-form">
                    <form action="{{ route('product.storeComment', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">コメント内容</label>
                            <textarea name="comment" id="content" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">コメントを送信する</button>
                    </form>
                </section>
            </section>
        </div>
    </main>

    <!-- Add JavaScript for the favorite toggle functionality -->
    <script>
        document.querySelector('.favorite-button').addEventListener('click', function() {
            const productId = this.dataset.productId;

            fetch(`/product/${productId}/favorite`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('favorited', data.favorited);
                    document.querySelector('.favorite-count').textContent = data.favorites_count;
                } else if (data.error) {
                    alert(data.error); // 例：ログインしていない場合のエラーメッセージ
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
