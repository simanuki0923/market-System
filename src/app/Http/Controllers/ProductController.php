<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;

class ProductController extends Controller
{
    public function product($id)
    {
        $product = Product::findOrFail($id);
        $isFavorited = auth()->check() && auth()->user()->favorites()->where('product_id', $id)->exists();

        return view('product', [
            'product' => $product,
            'isFavorited' => $isFavorited,
            'category' => $product->category->name ?? 'Uncategorized',
            'brand' => $product->brand,
            'condition' => $product->condition,
            'favorites_count' => $product->favorites_count,
            'comments_count' => $product->comments_count,
        ]);
    }

    public function toggleFavorite($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();
        $isFavorited = $user->favorites()->where('product_id', $product->id)->exists();

        if ($isFavorited) {
            $user->favorites()->where('product_id', $product->id)->delete();
        } else {
            $user->favorites()->create(['product_id' => $product->id]);
        }
        $favoritesCount = $product->favorites()->count();

        return response()->json([
            'success' => true,
            'favorited' => !$isFavorited,
            'favorites_count' => $favoritesCount
        ]);
    }

    public function showComments($id)
    {
        $product = Product::with(['comments.user.profile'])->findOrFail($id);
        $comments = $product->comments;
        $isFavorited = $product->favorites()->where('user_id', auth()->id())->exists();
        
        return view('comment', compact('product', 'comments', 'isFavorited'));
    }

    public function storeComment(StoreCommentRequest $request, $id)
    {
        Comment::create([
            'product_id' => $id,
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('product.comments', ['id' => $id])
                         ->with('success', 'コメントが投稿されました。');
    }

}