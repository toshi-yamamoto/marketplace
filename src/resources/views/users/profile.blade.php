@extends('layouts.app')

@section('title', 'プロフィール設定')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>プロフィール設定</h1>

    <form action="{{ route('users.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- プロフィール画像 -->
        <div class="profile-image">
            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}" alt="プロフィール画像">
            <label for="profile_image" class="image-button">画像を選択する</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">
        </div>

        <!-- ユーザー名 -->
        <label for="name">ユーザー名</label>
        <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <!-- 郵便番号 -->
        <label for="postal_code">郵便番号</label>
        <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}">
        @error('postal_code') <p class="error">{{ $message }}</p> @enderror

        <!-- 住所 -->
        <label for="address">住所</label>
        <input type="text" id="address" name="address" value="{{ old('address', Auth::user()->address) }}">
        @error('address') <p class="error">{{ $message }}</p> @enderror

        <!-- 建物名 -->
        <label for="building_name">建物名</label>
        <input type="text" id="building_name" name="building_name" value="{{ old('building_name', Auth::user()->building_name) }}">
        @error('building_name') <p class="error">{{ $message }}</p> @enderror

        <!-- 更新ボタン -->
        <button type="submit">更新する</button>
    </form>
</div>
@endsection
