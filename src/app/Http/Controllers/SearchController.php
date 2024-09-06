<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
{
    $searchTerm = $request->input('search');

    // Productsの複数カラムで検索
    $products = Product::where('name', 'like', "%{$searchTerm}%")
        ->orWhere('description', 'like', "%{$searchTerm}%")
        ->orWhere('brand', 'like', "%{$searchTerm}%")
        ->orWhere('condition', 'like', "%{$searchTerm}%")
        ->get();

    // Categoriesのnameで検索
    $categories = Category::where('name', 'like', "%{$searchTerm}%")
        ->get();

    // 検索されたCategoriesに属するProductsを取得（カテゴリIDでフィルタリング）
    $categoryProductIds = $categories->pluck('id');
    $categoryProducts = Product::whereIn('category_id', $categoryProductIds)->get();

    // 合わせてProductsとCategoryProductsを結合
    $products = $products->merge($categoryProducts)->unique('id');

    return view('search', compact('products', 'categories'));
}
}