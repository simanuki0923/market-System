@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('content')
    <main class="product-detail__main">
        <div class="product-detail__container">
            <!-- Left Half: Product Image -->
            <div class="product-detail__image">
                <img src="{{ $product->image_url ?? 'default_image.png' }}" alt="{{ $product->name ?? '商品名' }}">
            </div>

            <!-- Right Half: Product Information -->
            <div class="product-detail__info">
                <h2>{{ $product->name ?? '商品名' }}</h2>
                <p class="price">価格: {{ $product->price ?? '0' }}円</p>

                <!-- Favorite and Comment Buttons -->
                <div class="action-buttons">
                    <button>
                        <img class="iconstar" src="{{ asset('img/星.png') }}" alt="お気に入り">
                    </button>
                    <button type="button" onclick="window.location='{{ route('product') }}'">
                        <img class="iconcomment" src="{{ asset('img/吹き出し.png') }}" alt="コメントする">
                    </button>
                </div>

                <!-- Display Comments -->
                <div class="comments-section">
                    <h3>コメント一覧</h3>
                    @if(!empty($comments))
                        @foreach($comments as $comment)
            <div class="comment">
                <div class="comment-header">
                    <!-- Display user icon -->
                    <img src="{{ $comment['user_icon'] ?? 'default_icon.png' }}" alt="{{ $comment['user'] }}" class="user-icon">
                    <strong>{{ $comment['user'] }}</strong>
                </div>
                  <p>{{ $comment['content'] }}</p>
            </div>
                      @endforeach
                    @else
                        <p>コメントはまだありません。</p>
                    @endif
                </div>

                <!-- Comment Form -->
                <div class="comment-form">
                    <h3>コメントを投稿する</h3>
                    <form action="{{ route('product.storeComment', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">名前</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="content">コメント内容</label>
                            <textarea name="content" id="content" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">コメントを送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
