@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <main class="contact-form__main">
        <div class="profile-section">
            <div class="profile-icon">
                <img src="{{ $user->profile && $user->profile->icon_image_path ? asset('storage/' . $user->profile->icon_image_path) : asset('img/sample.jpg') }}" alt="{{ $user_name ?? $user->name }}のアイコン">
            </div>
            <div class="profile-info">
                <div class="profile-info-content">
                    <p class="user-name">{{ $user_name }}</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="edit-profile-btn">プロフィールを編集</a>
            </div>
        </div>
        <div class="toggle-links">
            <a href="javascript:void(0);" id="toggleListed" class="active">出品した商品</a>
            <a href="javascript:void(0);" id="togglePurchased">購入した商品</a>
        </div>

        <section id="listedProducts" class="product-list" role="list">
    @if($listedProducts->isNotEmpty())
        @foreach ($listedProducts as $product)
            <article class="product-item">
                <a href="{{ route('product', ['id' => $product->id]) }}">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                    @if ($product->is_sold)
                        <div class="sold-out-label">sold out</div>
                    @endif
                </a>
            </article>
        @endforeach
    @else
        <p>出品した商品はありません。</p>
    @endif
</section>

<section id="purchasedProducts" class="product-list" role="list" style="display: none;">
    @if($purchasedProducts->isNotEmpty())
        @foreach ($purchasedProducts as $product)
            <article class="product-item">
                <a href="{{ route('product', ['id' => $product['id']]) }}">
                    <img src="{{ $product['image_url'] ? asset('storage/' . $product['image_url']) : asset('storage/img/no-image.jpg') }}" alt="{{ $product['name'] }}">
                </a>
            </article>
        @endforeach
    @else
        <p>購入した商品はありません。</p>
    @endif
</section>
    </main>

    <script>
        document.getElementById('toggleListed').addEventListener('click', function() {
            toggleView('listedProducts', 'toggleListed', 'purchasedProducts', 'togglePurchased');
        });

        document.getElementById('togglePurchased').addEventListener('click', function() {
            toggleView('purchasedProducts', 'togglePurchased', 'listedProducts', 'toggleListed');
        });

        function toggleView(showSectionId, showLinkId, hideSectionId, hideLinkId) {
            document.getElementById(showSectionId).style.display = 'grid';
            document.getElementById(hideSectionId).style.display = 'none';
            document.getElementById(showLinkId).classList.add('active');
            document.getElementById(hideLinkId).classList.remove('active');
            document.getElementById(showLinkId).setAttribute('aria-pressed', 'true');
            document.getElementById(hideLinkId).setAttribute('aria-pressed', 'false');
        }

        document.getElementById('listedProducts').style.display = 'grid';
        document.getElementById('purchasedProducts').style.display = 'none';
    </script>
@endsection