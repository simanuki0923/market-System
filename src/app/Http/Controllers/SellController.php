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

    public function store(StoreProductRequest $request)
    {

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
        }

        $category = Category::firstOrCreate(['name' => $request->input('category')]);
        $categoryId = $category->id;

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