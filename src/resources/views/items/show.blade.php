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

            <div class="actions">
                <div class="likes">
                    <button class="like-button {{ $item->likes->contains('user_id', auth()->id()) ? 'liked' : '' }}" id="like-button" data-item-id="{{ $item->id }}">
                        <i class="fas fa-star"></i>
                    </button>
                    <span id="like-count">{{ $item->likes_count ?? 0 }}</span>
                </div>
                <div class="comments">
                    <i class="fas fa-comment"></i>
                    <span>{{ $item->comments_count ?? 0 }}</span>
                </div>
            </div>

            <a href="{{ route('purchases.create', ['item_id' => $item->id]) }}" class="purchase-btn">購入手続きへ</a>

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

            <!-- コメント -->
            <div class="comments-section">
                <h2>コメント ({{ $item->comments->count() }})</h2>

                    <!-- コメント一覧 -->
                    <div class="comment-list">
                        @forelse ($item->comments as $comment)
                            <div class="comment-item">
                                <div class="comment-header">
                                    <span class="comment-author">{{ $comment->user->name }}</span>
                                </div>
                                <div class="comment-content">
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>
                        @empty
                            <p>コメントはまだありません。</p>
                        @endforelse
                    </div>

                <form action="{{ route('comments.store', $item->id) }}" method="POST">
                    @csrf
                    <textarea name="content" placeholder="コメントを入力してください"></textarea>
                    @error('content')
                        <div class="error" style="color: red;">{{ $message }}</div>
                    @enderror
                    <button type="submit">コメントを送信する</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const likeButton = document.getElementById('like-button');
        if (likeButton) {
            likeButton.addEventListener('click', function () {
                const itemId = likeButton.dataset.itemId;

                fetch(`/items/${itemId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => {
                        if (response.status === 401) {
                            // 未認証の場合、ログインページにリダイレクト
                            return response.json().then(data => {
                                window.location.href = data.redirect;
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        const likeCount = document.getElementById('like-count');
                        if (data.status === 'added') {
                            likeCount.textContent = parseInt(likeCount.textContent) + 1;
                            likeButton.classList.add('liked');
                        } else if (data.status === 'removed') {
                            likeCount.textContent = parseInt(likeCount.textContent) - 1;
                            likeButton.classList.remove('liked');
                        }
                    })
                    .catch(error => {
                        console.error('エラー:', error);
                    });
            });
        }
    });
</script>
@endsection
