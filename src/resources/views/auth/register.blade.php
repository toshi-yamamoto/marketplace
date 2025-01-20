@extends('layouts.app')

@section('title', '会員登録')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>会員登録</h1>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- ユーザー名 -->
        <label for="name">ユーザー名</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- メールアドレス -->
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- パスワード -->
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- 確認用パスワード -->
        <label for="password_confirmation">確認用パスワード</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        @error('password_confirmation')
            <p class="error">{{ $message }}</p>
        @enderror

        <!-- 登録ボタン -->
        <button type="submit">登録する</button>
    </form>

    <!-- ログインページへのリンク -->
    <a href="{{ route('login') }}">ログインはこちら</a>
</div>
@endsection
