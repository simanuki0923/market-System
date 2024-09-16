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
        $products = Product::where('name', 'like', "%{$searchTerm}%")
        ->orWhere('description', 'like', "%{$searchTerm}%")
        ->orWhere('brand', 'like', "%{$searchTerm}%")
        ->orWhere('condition', 'like', "%{$searchTerm}%")
        ->get();
        $categories = Category::where('name', 'like', "%{$searchTerm}%")
        ->get();
        $categoryProductIds = $categories->pluck('id');
        $categoryProducts = Product::whereIn('category_id', $categoryProductIds)->get();
        $products = $products->merge($categoryProducts)->unique('id');

        return view('search', compact('products', 'categories'));
    }
}