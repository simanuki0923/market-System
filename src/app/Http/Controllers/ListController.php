<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\User;

class ListController extends Controller
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
                'image_url' => $favorite->product->image_url ? asset('storage/' . $favorite->product->image_url) : 'default-image.jpg',
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
}