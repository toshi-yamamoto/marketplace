<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COACHTECH')</title>
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <!-- ヘッダー -->
    <header class="header">
        <!-- ロゴは常に表示 -->
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="Coachtechロゴ">
            </a>
        </div>

        <div class="search-bar">
            <form action="{{ route('items.search') }}" method="GET">
                <input type="text" name="query" placeholder="なにをお探しですか？" value="{{ request('query') }}">
                <button type="submit" style="display: none">検索</button>
            </form>
        </div>

        <!-- ナビゲーションは条件分岐 -->
        @if (Route::currentRouteName() === 'login' || Route::currentRouteName() === 'register')
            <!-- ログイン・会員登録時はナビゲーションなし -->
        @else
            <div class="nav">
                @auth
                    <!-- 認証済みユーザー用 -->
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit"
                            style="background: none; border: none; color: #fff; cursor: pointer; text-decoration: underline;">ログアウト</button>
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

    @yield('scripts')
</body>

</html>
