<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Purchase;
use App\Models\Category;
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
            'category' => $favorite->product->category->name ?? 'Uncategorized',
            'brand' => $favorite->product->brand,
            'condition' => $favorite->product->condition,
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
        'category' => $product->category->name ?? 'Uncategorized',
        'brand' => $product->brand,
        'condition' => $product->condition,
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
    $user = auth()->user();
    
    // ユーザーが出品した商品を取得
    $listedProducts = $user->products()->get(); // or use ->toArray() if needed
    
    // ユーザーが購入した商品を取得し、その商品情報を含める
    $purchasedProducts = $user->purchases()->with('product')->get()->map(function ($purchase) {
        return [
            'id' => $purchase->product->id,
            'name' => $purchase->product->name,
            'image_url' => $purchase->product->image_url,
            'link' => route('product', ['id' => $purchase->product->id]),
            'category' => $purchase->product->category->name ?? 'Uncategorized',
            'brand' => $purchase->product->brand,
            'condition' => $purchase->product->condition,
        ];
    });

    // アイコン画像のURLを生成
    $iconUrl = $user->profile && $user->profile->icon_image_path 
        ? asset('storage/' . str_replace('public/', '', $user->profile->icon_image_path)) 
        : asset('img/sample.jpg');

    return view('mypage', [
        'user' => $user,
        'listedProducts' => $listedProducts,
        'purchasedProducts' => $purchasedProducts,
        'icon_url' => $iconUrl
    ]);
   }

   public function edit()
   {
    $user = auth()->user(); // または、必要に応じてユーザーを取得するロジック
    return view('profile', compact('user'));
   }

   public function update(Request $request)
   {
    $user = auth()->user();
    $profile = $user->profile;

    // バリデーション
    $request->validate([
        'name' => 'required|string|max:255',
        'icon_image' => 'nullable|image|max:2048',
        // 他のバリデーションルール
    ]);

    // プロフィールの更新
    $profile->name = $request->input('name');

    if ($request->hasFile('icon_image')) {
        $iconPath = $request->file('icon_image')->store('public/icons');
        $profile->icon_image_path = str_replace('public/', '', $iconPath);
    }

    // 他のフィールドも更新

    $profile->save();

    return redirect()->route('profile.edit')->with('success', 'プロフィールが更新されました。');
   }
    
}
