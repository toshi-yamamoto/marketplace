<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COACHTECH')</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @stack('css')
</head>
<body>
    <!-- ヘッダー -->
<header class="header">
    @if (Route::currentRouteName() === 'login' || Route::currentRouteName() === 'register')
        <!-- ログイン・会員登録時のロゴのみのヘッダー -->
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="Coachtechロゴ">
            </a>
        </div>
    @else
        <!-- 通常のヘッダー -->
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="Coachtechロゴ">
            </a>
        </div>

        <div class="nav">
            @auth
                <!-- 認証済みユーザー用 -->
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #fff; cursor: pointer; text-decoration: underline;">ログアウト</button>
                </form>
                <a href="{{ route('users.profile') }}">マイページ</a>
                <a href="{{ route('items.create') }}">出品</a>
            @else
                <!-- 未認証ユーザー用 -->
                <a href="{{ route('login') }}">ログイン</a>
                <a href="{{ route('login') }}">マイページ</a>
                <a href="{{ route('login') }}">出品</a>
            @endauth
        </div>
    @endif
</header>

    <!-- メインコンテンツ -->
    <main>
        @yield('content')
    </main>

    <!-- フッター -->
    <footer>
        <p>&copy; 2024 COACHTECH. All Rights Reserved.</p>
    </footer>
</body>
</html>
