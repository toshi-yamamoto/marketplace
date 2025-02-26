<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;

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

// 商品一覧ページ
Route::get('/', [ItemController::class, 'index'])->name('items.index');

// 商品詳細ページ
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show');

// 商品検索
Route::get('/search', [ItemController::class, 'search'])->name('items.search');

// ログイン
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ログアウト
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'ログアウトしました！');
})->name('logout');

// 会員登録
Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    // プロフィール登録
    Route::get('/profile', [UserController::class, 'edit'])->name('users.profile');

    // プロフィール更新処理
    Route::put('/profile', [UserController::class, 'update'])->name('users.profile.update');

    // マイページ
    Route::get('/mypage', [UserController::class, 'mypage'])->name('users.mypage');

    // 出品ページ
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

    // コメント登録処理
    Route::post('/item/{item_id}/comments', [CommentController::class, 'store'])
        ->name('comments.store'); // コメント投稿は認証が必要

    // 商品購入画面
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'create'])->name('purchases.create');

    // 購入処理
    Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchases.store');

    // 住所変更画面
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'editAddress'])->name('purchases.editAddress');

    // 住所変更処理
    Route::put('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress'])->name('purchases.updateAddress');
});

// いいね登録処理（未認証でもJSでリダイレクト処理済みの場合）
Route::post('/items/{itemId}/like', [LikeController::class, 'toggleLike'])->name('items.like');
