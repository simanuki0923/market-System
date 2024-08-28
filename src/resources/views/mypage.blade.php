@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <main class="contact-form__main">
        <div class="profile-section">
            <div class="profile-icon">
                <img src="{{ asset('img/星.png') }}" alt="User Icon">
            </div>
            <div class="profile-info">
                <div class="profile-info-content">
                    <p class="user-name">ユーザー名</p>
                </div>
                <a href="{{ route('profile.update') }}" class="edit-profile-btn">プロフィール編集</a>
            </div>
        </div>
        <div class="toggle-links">
            <a href="javascript:void(0);" id="toggleListed" class="active">出品した商品</a>
            <a href="javascript:void(0);" id="togglePurchased">購入した商品</a>
        </div>

        <div id="listedProducts" class="product-list">
            @foreach ($listedProducts as $product)
                <div class="product-item">
                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                    <p>{{ $product['name'] }}</p>
                </div>
            @endforeach
        </div>

        <div id="purchasedProducts" class="product-list" style="display: none;">
            @foreach ($purchasedProducts as $product)
                <div class="product-item">
                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                    <p>{{ $product['name'] }}</p>
                    <a href="{{ $product['link'] }}">商品リンク</a>
                </div>
            @endforeach
        </div>
    </main>

    <script>
        document.getElementById('toggleListed').addEventListener('click', function() {
            document.getElementById('listedProducts').style.display = 'grid';
            document.getElementById('purchasedProducts').style.display = 'none';
            document.getElementById('toggleListed').classList.add('active');
            document.getElementById('togglePurchased').classList.remove('active');
        });

        document.getElementById('togglePurchased').addEventListener('click', function() {
            document.getElementById('listedProducts').style.display = 'none';
            document.getElementById('purchasedProducts').style.display = 'grid';
            document.getElementById('toggleListed').classList.remove('active');
            document.getElementById('togglePurchased').classList.add('active');
        });

        // Set default view to 'listedProducts'
        document.getElementById('listedProducts').style.display = 'grid';
        document.getElementById('purchasedProducts').style.display = 'none';
    </script>
@endsection