@extends('layouts.app')

@section('title', '配送先住所の変更')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>配送先住所の変更</h1>

    <!-- 住所変更フォーム -->
    <form action="{{ route('purchases.updateAddress', ['item_id' => $item->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- 郵便番号 -->
        <label for="zip">郵便番号</label>
        <input type="text" id="zip" name="zip" value="{{ old('zip', $user->zip) }}" required>

        <!-- 住所 -->
        <label for="address">住所</label>
        <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" required>

        <!-- 建物名 -->
        <label for="building">建物名（任意）</label>
        <input type="text" id="building" name="building" value="{{ old('building', $user->building) }}">

        <!-- 更新ボタン -->
        <button type="submit" class="btn btn-primary">住所を更新する</button>
    </form>
</div>
@endsection
