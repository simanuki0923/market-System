<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ListController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ホーム画面ページ
Route::get('/', [ListController::class, 'list'])->name('product.list');

// 商品詳細ページ
Route::get('/product/{id}', [ProductController::class, 'product'])->name('product');

// お気に入りのトグル（ログインしていない場合リダイレクト）
Route::post('/product/{id}/favorite', [ProductController::class, 'toggleFavorite'])
    ->name('product.toggleFavorite')
    ->middleware('auth');

// ログアウト処理
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// ログアウト後のリダイレクト
Route::get('/logout-redirect', function () {
    return redirect()->route('product.list');
});

// ログインが必要なルート
Route::middleware('auth')->group(function () {

    // コメントページ
    Route::get('/product/{id}/comments', [ProductController::class, 'showComments'])->name('product.comments');
    Route::post('/product/{id}/comments', [ProductController::class, 'storeComment'])->name('product.storeComment');
    Route::delete('/product/{productId}/comments/{commentId}', [ProductController::class, 'destroyComment'])->name('product.destroyComment');

    // 購入ページ
    Route::get('/purchase', [ProductController::class, 'purchase'])->name('purchase');

    // 住所登録ページ
    Route::get('/address', [ProductController::class, 'editAddress'])->name('address.edit');
    Route::post('/address/update', [ProductController::class, 'updateAddress'])->name('address.update');

    // マイページ
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');

    // プロフィール編集ページ
    Route::get('/profile', [MypageController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [MypageController::class, 'update'])->name('profile.update');

    // 出品ページ
    Route::get('/sell', [TestController::class, 'sell'])->name('sell');
});