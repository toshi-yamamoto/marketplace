@extends('layouts.app')

@section('title', $item->name)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <!-- 商品詳細セクション -->
    <div class="item-detail">
        <!-- 左側: 商品画像 -->
        <div class="image">
            <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->name }}">
        </div>
        <!-- 右側: 商品情報 -->
        <div class="info">
            <h1>{{ $item->name }}</h1>
            <p>ブランド名: {{ $item->brand_name }}</p>
            <p>価格: ¥{{ number_format($item->price) }} (税込)</p>

            <!-- いいねボタンとコメント情報 -->
            <div class="actions">
                <div class="likes">
                    <button class="like-button">
                        <i class="fas fa-star"></i> <!-- いいねアイコン -->
                    </button>
                    <span>{{ $item->likes_count ?? 0 }}</span>
                </div>
                <div class="comments">
                    <i class="fas fa-comment"></i> <!-- コメントアイコン -->
                    <span>{{ $item->comments_count ?? 0 }}</span>
                </div>
            </div>

            <a href="#" class="purchase-btn">購入手続きへ</a>
        </div>
    </div>

    <!-- 商品説明、商品情報、コメントセクション -->
    <div class="item-extra">
        <!-- 商品説明 -->
        <div class="description">
            <h2>商品説明</h2>
            <p>{{ $item->description }}</p>
        </div>

        <!-- 商品情報 -->
        <div class="details">
            <h2>商品の情報</h2>
            <p>カテゴリ: {{ $item->category }}</p>
            <p>商品の状態: {{ $item->condition }}</p>
        </div>

        <!-- コメントセクション -->
        <div class="comments-section">
            <h2>コメント ({{ $item->comments->count() }})</h2>

            @foreach ($item->comments as $comment)
                <div class="comment">
                    <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
                </div>
            @endforeach

            <!-- コメント入力フォーム -->
            <form action="{{ route('comments.store', ['item_id' => $item->id]) }}" method="POST">
                @csrf
                <textarea name="content" placeholder="コメントを入力してください"></textarea>
                <button type="submit">コメントを送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection
