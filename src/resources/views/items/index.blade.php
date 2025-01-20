@extends('layouts.app')

@section('title', '商品一覧')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="header">
        <h1>商品一覧</h1>
        <div class="tabs">
            <a href="?tab=recommend" class="{{ request('tab') === 'recommend' ? 'active' : '' }}">おすすめ</a>
            <a href="?tab=mylist" class="{{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a>
        </div>
    </div>

    <div class="item-list">
        @forelse($items as $item)
            <div class="item-card">
                <img src="{{ $item->image_url ? asset('storage/' . $item->image_url) : asset('images/default-item.png') }}"
                    alt="商品画像">
                <p>{{ $item->name }}</p>
            </div>
        @empty
            <p>商品がありません。</p>
        @endforelse
    </div>
</div>
@endsection
