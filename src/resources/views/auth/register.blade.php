@extends('layouts.app')

@section('title', '会員登録')

@push('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<div class="container">
<form action="{{ route('register') }}" method="POST" novalidate>
    @csrf
    <label for="name">ユーザー名</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    @error('name') <p class="error">{{ $message }}</p> @enderror

    <label for="email">メールアドレス</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    @error('email') <p class="error">{{ $message }}</p> @enderror

    <label for="password">パスワード</label>
    <input type="password" id="password" name="password" required>
    @error('password') <p class="error">{{ $message }}</p> @enderror

    <label for="password_confirmation">パスワード（確認）</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>
    @error('password_confirmation') <p class="error">{{ $message }}</p> @enderror

    <button type="submit">会員登録</button>
</form>

    <!-- ログインページへのリンク -->
    <a href="{{ route('login') }}">ログインはこちら</a>
</div>
@endsection
