@extends('layouts.app')

@section('title', '商品購入')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品購入</h1>

    <!-- 商品情報 -->
    <div class="item-detail">
        <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->name }}" class="item-image">
        <p>商品名: {{ $item->name }}</p>
        <p>価格: ¥{{ number_format($item->price) }}</p>
    </div>

    <!-- 購入フォーム -->
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">

        <!-- 支払い方法 -->
        <label for="payment_method">支払い方法</label>
        <select name="payment_method" id="payment_method" required>
            <option value="">選択してください</option>
            <option value="コンビニ払い">コンビニ払い</option>
            <option value="クレジットカード">クレジットカード</option>
        </select>

        <!-- 配送先住所 -->
        <h3>配送先住所</h3>
        <p>〒{{ $user->zip }}</p>
        <p>{{ $user->address }}</p>
        <p>{{ $user->building }}</p>
        <a href="{{ route('purchases.editAddress', ['item_id' => $item->id]) }}">配送先を変更する</a>

        <!-- 購入ボタン -->
        <button type="submit" class="btn btn-primary">購入を確定する</button>
    </form>
</div>
@endsection
