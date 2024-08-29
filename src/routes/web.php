<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
Route::get('/', [ProductController::class, 'list'])->name('product.list');

// 商品詳細ページ
Route::get('/product/{id}', [ProductController::class, 'product'])->name('product');

// ログアウト処理
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// ログアウト後のリダイレクト
Route::get('/logout-redirect', function () {
    return redirect()->route('product.list');
});

Route::middleware('auth')->group(function () {

Route::get('/product/{id}/comments', [ProductController::class, 'showComments'])->name('product.comments');
Route::post('/product/{id}/comments', [ProductController::class, 'storeComment'])->name('product.storeComment');

// 購入ページ
Route::get('/purchase', [ProductController::class, 'purchase'])->name('purchase');

// 住所登録ページ
Route::get('/address', [ProductController::class, 'editAddress'])->name('address.edit');
Route::post('/address/update', [ProductController::class, 'updateAddress'])->name('address.update');

// マイページ
Route::get('/mypage', [ProductController::class, 'mypage'])->name('mypage');

// プロフィール編集ページ
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// 出品ページ
Route::get('/sell', [TestController::class, 'sell'])->name('sell');
});
