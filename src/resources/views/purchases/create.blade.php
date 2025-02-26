@extends('layouts.app')

@section('title', '商品購入')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="container">
    <!-- 左右2カラムで商品情報と購入フォームを配置 -->
    <div class="purchase-detail">
        <!-- 左カラム -->
        <div class="left">
            <h1>商品購入</h1>

            <!-- 商品情報 -->
            <div class="product-info">
                @if($item->item_image)
                    <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->name }}" class="product-image">
                @else
                    <!-- 画像がない場合の簡易表示 -->
                    <div class="product-image">No Image</div>
                @endif

                <div class="product-name">
                    <h1>{{ $item->name }}</h1>
                    <p>¥{{ number_format($item->price) }}</p>
                </div>
            </div>

            <h2>支払い方法</h2>
            <!-- 購入フォーム -->
            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">

                <select name="payment_method" id="payment_method" required>
                    <option value="">選択してください</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="クレジットカード">クレジットカード</option>
                </select>

                <h2>配送先住所</h2>
                <p>〒{{ $user->zip }}</p>
                <p>{{ $user->address }}</p>
                <p>{{ $user->building }}</p>
                <a href="{{ route('purchases.editAddress', ['item_id' => $item->id]) }}">配送先を変更する</a>

                <!-- 購入ボタン -->
                <button type="submit" class="purchase-btn">購入を確定する</button>
            </form>
        </div>

        <!-- 右カラム -->
        <div class="right">
            <h2>ご注文内容</h2>
            <div class="summary">
                <span>商品名</span>
                <span>{{ $item->name }}</span>
            </div>
            <div class="summary">
                <span>価格</span>
                <span>¥{{ number_format($item->price) }}</span>
            </div>
            <div class="summary">
                <span>支払い方法</span>
                <!-- リアルタイム反映用にIDを追加 -->
                <span id="order-payment-method">-</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentSelect = document.getElementById('payment_method');
        const orderPaymentMethod = document.getElementById('order-payment-method');

        // 支払い方法の選択値が変更されたとき
        paymentSelect.addEventListener('change', function () {
            // 選択された値を右側に反映
            orderPaymentMethod.textContent = paymentSelect.value || '-';
        });
    });
</script>
@endsection
