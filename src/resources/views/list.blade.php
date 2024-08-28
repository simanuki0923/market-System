@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
    <main class="contact-form__main">
        <div class="toggle-links">
            <a href="javascript:void(0);" id="toggleRecommended">おすすめ</a>
            <a href="javascript:void(0);" id="toggleMyList">マイリスト</a>
        </div>

        <div id="recommendedProducts" class="product-list">
            @foreach ($recommendedProducts as $recommended)
                <div class="product-item">
                    <img src="{{ asset($recommended['image']) }}" alt="{{ $recommended['name'] }}">
                </div>
            @endforeach
        </div>

        <div id="myList" class="my-list" style="display: none;">
            @foreach ($myList as $item)
                <div class="list-item">
                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                    <a href="{{ $item['link'] }}">リンク</a>
                </div>
            @endforeach
        </div>
    </main>

    <script>
        document.getElementById('toggleRecommended').addEventListener('click', function() {
            document.getElementById('recommendedProducts').style.display = 'grid';
            document.getElementById('myList').style.display = 'none';
        });

        document.getElementById('toggleMyList').addEventListener('click', function() {
            document.getElementById('recommendedProducts').style.display = 'none';
            document.getElementById('myList').style.display = 'grid';
        });
    </script>
@endsection