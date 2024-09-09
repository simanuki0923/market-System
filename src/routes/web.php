<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;

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

//検索ソート機能
Route::get('/search', [SearchController::class, 'index'])->name('search');

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
    Route::get('/purchase', [PurchaseController::class, 'purchase'])->name('purchase');

    // 配送先変更ページ
    Route::get('/purchase/address/edit', [PurchaseController::class, 'editAddress'])->name('purchase.address.edit');

    // 配送先変更処理
    Route::post('/purchase/address/update', [PurchaseController::class, 'updateAddress'])->name('purchase.address.update');

    // マイページ
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');

    // プロフィール編集ページ
    Route::get('/profile', [MypageController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [MypageController::class, 'update'])->name('profile.update');

    // 出品フォーム表示
    Route::get('/sell', [SellController::class, 'showForm'])->name('sell.show');

    // 出品データの保存
    Route::post('/sell', [SellController::class, 'store'])->name('sell.store');

    // payment決済実装
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/create', [PaymentController::class, 'create'])->name('create');
        Route::post('/store', [PaymentController::class, 'store'])->name('store');
        Route::get('/done', [PaymentController::class, 'done'])->name('done');
    });

    Route::get('/edit-payment-method', [PurchaseController::class, 'editPaymentMethod'])->name('edit.payment.method');
    Route::post('/update-payment-method', [PurchaseController::class, 'updatePaymentMethod'])->name('update.payment.method');
    
});

Route::get('/admin-login', [AdminLoginController::class, 'create'])->name('admin.login');
Route::post('/admin-login', [AdminLoginController::class, 'store'])->name('admin.login.store');
Route::post('/admin-logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

    // 管理者用ルート
Route::middleware(['auth:admins', 'role:admins'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.showUsers');
    Route::get('/admin/comment', [AdminController::class, 'showComments'])->name('admin.showComments');
    Route::delete('/admin/comment/delete/{id}', [AdminController::class, 'deleteComment'])->name('admin.deleteComment');
});