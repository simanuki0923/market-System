<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product($id)
    {
        // 商品をデータベースから取得
        $product = Product::findOrFail($id);

        // お気に入りされているかをチェック
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
        $product = Product::with(['comments.user.profile'])->findOrFail($id);
        $comments = $product->comments;
        $isFavorited = $product->favorites()->where('user_id', auth()->id())->exists();
        
        return view('comment', compact('product', 'comments', 'isFavorited'));
    }

    public function storeComment(Request $request, $id)
    {
        // 入力バリデーション
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        // コメントをデータベースに保存
        Comment::create([
            'product_id' => $id,
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'), // カラム名に合わせる
        ]);

        // コメントページにリダイレクトし、成功メッセージを表示
        return redirect()->route('product.comments', ['id' => $id])
                         ->with('success', 'コメントが投稿されました。');
    }

    public function destroyComment($productId, $commentId)
{
    $comment = Comment::where('id', $commentId)
                      ->where('user_id', auth()->id())
                      ->firstOrFail();

    $comment->delete();

    return redirect()->route('product.comments', ['id' => $productId])
                     ->with('success', 'コメントが削除されました。');
}
}