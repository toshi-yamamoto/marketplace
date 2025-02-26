@extends('layouts.app')

@section('title', '商品一覧')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="navigation">
        <div class="tabs">
            <a href="{{ route('items.index', ['tab' => 'recommend']) }}"
                class="{{ request('tab') === 'recommend' || !request('tab') ? 'active' : '' }}">おすすめ</a>
            <a href="{{ route('items.index', ['tab' => 'mylist']) }}"
                class="{{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
        </div>
    </div>

    <div class="item-list">
        @forelse ($items as $item)
            <div class="item-card">
                <!-- 商品画像部分 -->
                <a href="{{ route('items.show', $item->id) }}" class="image-link">
                    <div class="image-container">
                        <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->name }}">
                        @if($item->purchase)
                            <div class="sold-overlay">SOLD</div>
                        @endif
                    </div>
                </a>
                <!-- 商品名 -->
                <a href="{{ route('items.show', $item->id) }}">
                    <p>{{ $item->name }}</p>
                </a>
            </div>
        @empty
            <p>商品がありません。</p>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/index.js') }}"></script>
@endsection
