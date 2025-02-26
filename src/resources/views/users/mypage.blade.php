<!-- resources/views/users/mypage.blade.php -->
@extends('layouts.app')

@section('title', 'マイページ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="container">
    <!-- 上部ユーザー情報 -->
    <div class="profile-header">
        @if($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" class="profile-image">
        @else
            <div class="profile-dummy"></div>
        @endif
        <div class="profile-info">
            <h1>{{ $user->name }}</h1>
            <a href="{{ route('users.profile') }}" class="edit-profile-btn">プロフィールを編集</a>
        </div>
    </div>

    <!-- タブ切り替え -->
    <div class="navigation">
        <div class="tabs">
            <!-- 出品した商品タブ -->
            <a href="{{ route('users.mypage', ['tab' => 'posted']) }}"
                class="{{ request('tab') === 'posted' || !request('tab') ? 'active' : '' }}">
                出品した商品
            </a>

            <!-- 購入した商品タブ -->
            <a href="{{ route('users.mypage', ['tab' => 'purchased']) }}"
                class="{{ request('tab') === 'purchased' ? 'active' : '' }}">
                購入した商品
            </a>
        </div>
    </div>

    <!-- タブの内容切り替え -->
    @if(request('tab') === 'purchased')
        {{-- 購入した商品 --}}
        <div class="item-list">
            @forelse($purchasedItems as $item)
                <div class="item-card">
                    <a href="{{ route('items.show', $item->id) }}">
                        @if($item->item_image)
                            <img src="{{ asset('storage/' . $item->item_image) }}" alt="商品画像">
                        @else
                            <div class="no-image">No Image</div>
                        @endif
                    </a>
                    <p>{{ $item->name }}</p>
                </div>
            @empty
                <p>購入した商品はありません。</p>
            @endforelse
        </div>
    @else
        {{-- 出品した商品 --}}
        <div class="item-list">
            @forelse($postedItems as $item)
                <div class="item-card">
                    <a href="{{ route('items.show', $item->id) }}">
                        @if($item->item_image)
                            <img src="{{ asset('storage/' . $item->item_image) }}" alt="商品画像">
                        @else
                            <div class="no-image">No Image</div>
                        @endif
                    </a>
                    <p>{{ $item->name }}</p>
                </div>
            @empty
                <p>出品した商品はありません。</p>
            @endforelse
        </div>
    @endif
</div>
@endsection
