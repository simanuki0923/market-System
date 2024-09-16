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

    $recommendedProducts = Product::all();
    $user = auth()->user();
    $myList = $user ? $user->favorites()->with('product')->get()->map(function ($favorite) {

            if (!$favorite->product) {
                return null;
            }

        return [
            'id' => $favorite->product->id,
            'name' => $favorite->product->name,
            'image_url' => $favorite->product->image_url ? asset('storage/' . $favorite->product->image_url) : 'default-image.jpg',
            'link' => route('product', ['id' => $favorite->product->id]),
            'category' => $favorite->product->category->name ?? 'Uncategorized',
            'brand' => $favorite->product->brand,
            'condition' => $favorite->product->condition,
            'is_sold' => $favorite->product->is_sold,
        ];
    })->filter()->all() : [];

    return view('list', [
        'recommendedProducts' => $recommendedProducts,
        'myList' => $myList,
    ]);
}
}