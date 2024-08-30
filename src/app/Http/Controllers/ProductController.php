<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use App\Models\Favorite;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
{
    // おすすめ商品をデータベースから取得
    $recommendedProducts = Product::all(); 

    // 現在ログインしているユーザー
    $user = auth()->user();

    // マイリスト（お気に入り）を取得
    $myList = $user ? $user->favorites()->with('product')->get()->map(function ($favorite) {
        return [
            'id' => $favorite->product->id,
            'name' => $favorite->product->name,
            'image_url' => $favorite->product->image_url,
            'link' => route('product', ['id' => $favorite->product->id]),
        ];
    }) : [];

    return view('list', [
        'recommendedProducts' => $recommendedProducts,
        'myList' => $myList,
    ]);
}

public function product($id)
{
    // 商品をデータベースから取得
    $product = Product::find($id);

    // 商品が見つからない場合の処理
    if (!$product) {
        abort(404, '商品が見つかりません');
    }

    // お気に入りされているかをチェック
    $isFavorited = auth()->check() && auth()->user()->favorites()->where('product_id', $id)->exists();

    return view('product', [
        'product' => $product,
        'isFavorited' => $isFavorited,
    ]);
}

   public function toggleFavorite($id)
{
    $product = Product::findOrFail($id);
    $user = auth()->user();
    
    // お気に入りをトグル（追加または削除）
    $isFavorited = $user->favorites()->where('product_id', $product->id)->exists();

    if ($isFavorited) {
        // お気に入りから削除
        $user->favorites()->where('product_id', $product->id)->delete();
    } else {
        // お気に入りに追加
        $user->favorites()->create(['product_id' => $product->id]);
    }

    // 現在のお気に入り数を取得
    $favoritesCount = $product->favorites()->count();

    return response()->json([
        'success' => true,
        'favorited' => !$isFavorited,
        'favorites_count' => $favoritesCount
    ]);
}

    public function showComments($id)
{
    // 仮データ
    $product = (object) [
        'id' => $id,
        'image_url' => 'img/サンプル画像.png',
        'name' => '商品名',
        'description' => '商品説明',
        'price' => 1000
    ];

    $comments = [
        ['user' => 'User1', 'content' => 'This is a great product!'],
        ['user' => 'User2', 'content' => 'I found it very useful.'],
        ['user' => 'User3', 'content' => 'Would recommend to others.']
    ];

    return view('comment', compact('product', 'comments'));
}
    
    public function storeComment(Request $request, $id)
{
    // コメントを保存する処理
    return redirect()->route('product.comments', ['id' => $id])
                     ->with('success', 'コメントが投稿されました。');
}

  public function mypage()
    {
      $product = [
        'image' => 'img/サンプル画像.png',
    ];

    // 出品商品データを仮に用意します
    $listedProducts = [
        ['name' => 'Listed Product 1', 'image' => 'img/サンプル画像.png'],
        ['name' => 'Listed Product 2', 'image' => 'img/サンプル画像.png'],
        ['name' => 'Listed Product 3', 'image' => 'img/サンプル画像.png'],
        ['name' => 'Listed Product 4', 'image' => 'img/サンプル画像.png'],
        ['name' => 'Listed Product 5', 'image' => 'img/サンプル画像.png'],

    ];

    // 購入商品データを仮に用意します
    $purchasedProducts = [
        ['name' => 'Purchased Product 1', 'link' => '#', 'image' => 'img/サンプル画像.png'],
        ['name' => 'Purchased Product 2', 'link' => '#', 'image' => 'img/サンプル画像.png'],
        ['name' => 'Purchased Product 3', 'link' => '#', 'image' => 'img/サンプル画像.png'],
        ['name' => 'Purchased Product 4', 'link' => '#', 'image' => 'img/サンプル画像.png'],
        ['name' => 'Purchased Product 5', 'link' => '#', 'image' => 'img/サンプル画像.png'],

    ];

    return view('mypage', [
        'product' => $product,
        'listedProducts' => $listedProducts,
        'purchasedProducts' => $purchasedProducts,
    ]); 
    }

    public function editAddress()
    {
        // Mock data
        $user = (object) [
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区神南1丁目',
            'building' => 'Mock Building 101',
        ];

        return view('address', compact('user'));
    }

    // Method to handle the form submission (this can stay the same)
    public function updateAddress(Request $request)
    {
        // Validation and update logic as previously provided
        // For mock data, this would typically not be executed
        return redirect()->back()->with('success', '住所が更新されました。');
    }

    public function purchase()
{
    $mockData = [
        'product_image' => 'img//サンプル画像.png',
        'product_name' => '商品名',
        'price' => '¥3,000',
        'payment_method' => 'クレジットカード',
        'shipping_address' => '東京都渋谷区1-2-3',
        'total_amount' => '¥3,000',
    ];

    return view('purchase', compact('mockData'));
}

    
}
