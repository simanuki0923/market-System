<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function showForm()
    {
        return view('sell');
    }

    /**
     * 商品のデータを保存する
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        // 商品画像の保存
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
        }

        // カテゴリー名からIDを取得または新規作成
        $category = Category::firstOrCreate(['name' => $request->input('category')]);
        $categoryId = $category->id;

        // 商品データの保存
        Product::create([
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $categoryId,
            'condition' => $request->input('condition'),
            'image_url' => $imagePath
        ]);

        return redirect()->route('sell.show')->with('success', '商品が出品されました');
    }
}