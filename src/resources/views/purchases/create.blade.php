@extends('layouts.app')

@section('title', '商品購入')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="purchase-detail">
        <!-- 左側: 商品情報 -->
        <div class="left">
            <!-- 商品画像と商品名 -->
            <div class="product-info">
                <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->name }}" class="product-image">
                <div class="product-name">
                    <h1>{{ $item->name }}</h1>
                    <p>¥{{ number_format($item->price) }}</p>
                </div>
            </div>

            <!-- 支払い方法 -->
            <div class="payment-method">
                <h2>支払い方法</h2>
                <form method="POST" action="{{ route('purchases.store', $item->id) }}">
                    @csrf
                    <select name="payment_method" id="payment-method" required>
                        <option value="">選択してください</option>
                        <option value="クレジットカード">クレジットカード</option>
                        <option value="コンビニ払い">コンビニ払い</option>
                    </select>
                </form>
            </div>

            <!-- 配送先 -->
            <div class="shipping-address">
                <h2>配送先</h2>
                <p>〒{{ $user->postal_code }}</p>
                <p>{{ $user->address }}</p>
                <p>{{ $user->building_name}}</p>
                <a href="{{ route('purchases.editAddress', $item->id) }}">変更する</a>
            </div>
        </div>

        <!-- 右側: 料金とボタン -->
        <div class="right">
            <div class="summary">
                <p>商品代金</p>
                <p>¥{{ number_format($item->price) }}</p>
            </div>

            <div class="summary">
                <p>支払い方法</p>
                <p id="selected-payment-method">選択してください</p>
            </div>

            <button type="submit" class="purchase-btn">購入する</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentMethodSelect = document.getElementById('payment-method');
        const selectedPaymentMethod = document.getElementById('selected-payment-method');

        // 支払い方法の選択が変更されたときに右側に反映
        paymentMethodSelect.addEventListener('change', function () {
            selectedPaymentMethod.textContent = this.value || '選択してください';
        });
    });
</script>
@endsection
