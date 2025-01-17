@extends('layouts.app')

@section('title', 'ログイン')

@push('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<div class="container">
    <h1>ログイン</h1>
    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <!-- メールアドレス / ユーザー名 -->
        <label for="email">ユーザー名 / メールアドレス</label>
        <input type="text" id="email" name="email" value="{{ old('email') }}" required>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <!-- パスワード -->
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <!-- ログインボタン -->
        <button type="submit">ログインする</button>
    </form>

    <!-- 会員登録ページへのリンク -->
    <a href="{{ route('register') }}">会員登録はこちら</a>
</div>
@endsection
