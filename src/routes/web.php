<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Mail; // mailhog test

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

Route::get('/search', [ItemController::class, 'search'])->name('items.search');

// ログイン
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ログアウト
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'ログアウトしました！');
})->name('logout');

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    // マイページ
    Route::get('/profile', [UserController::class, 'edit'])->name('users.profile');

    // 出品ページ
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
});

// 会員登録
Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// プロフィール設定画面
Route::get('/profile', [UserController::class, 'edit'])->middleware('auth')->name('users.profile');

// プロフィール更新処理
Route::put('/profile', [UserController::class, 'update'])->middleware('auth')->name('users.profile.update');

// 商品作成画面
Route::get('/items/create', [ItemController::class, 'create'])->middleware('auth')->name('items.create');

// コメント登録処理
Route::post('/item/{item_id}/comments', [CommentController::class, 'store'])->name('comments.store');

// いいね登録処理
Route::post('/items/{itemId}/like', [LikeController::class, 'toggleLike'])->name('items.like');

// mailhogテストメール用
Route::get('/test-mail', function () {
    $details = [
        'subject' => 'テストメール',
        'body' => 'これはテストメールです。MailHogを使用してメール送信をテストしています。',
    ];

    Mail::raw($details['body'], function ($message) use ($details) {
        $message->to('test@example.com') // 受信者のメールアドレス（MailHogでキャプチャされます）
            ->subject($details['subject']); // 件名
    });

    return 'メール送信テスト完了！';
});
