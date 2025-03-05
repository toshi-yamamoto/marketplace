@extends('layouts.app')

@section('title', '商品の出品')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create-item.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1>商品の出品</h1>

        <!-- エラーメッセージ表示（バリデーション用） -->
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 商品出品フォーム -->
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- 商品画像 -->
            <div class="form-group">
                <label for="item_image">商品画像</label>
                <input type="file" id="item_image" name="item_image" accept="image/*">
            </div>

            <!-- 商品の状態 -->
            <div class="form-group">
                <label for="condition">商品の状態</label>
                <select name="condition" id="condition">
                    <option value="良好">良好</option>
                    <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="状態が悪い">状態が悪い</option>
                </select>
            </div>

            <!-- ★ カテゴリー：チェックボックスで複数選択できるように変更 ★ -->
            <div class="form-group">
                <label>カテゴリー</label>
                <div class="category-buttons">
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="ファッション">
                        <span>ファッション</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="レディース">
                        <span>レディース</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="メンズ">
                        <span>メンズ</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="インテリア">
                        <span>インテリア</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="家電">
                        <span>家電</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="本">
                        <span>本</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="趣味">
                        <span>趣味</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="コスメ">
                        <span>コスメ</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="おもちゃ">
                        <span>おもちゃ</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="スポーツ">
                        <span>スポーツ</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="キッチン">
                        <span>キッチン</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="ハンドメイド">
                        <span>ハンドメイド</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="アクセサリー">
                        <span>アクセサリー</span>
                    </label>
                    <label class="category-button">
                        <input type="checkbox" name="categories[]" value="ベビー・キッズ">
                        <span>ベビー・キッズ</span>
                    </label>
                </div>
            </div>

            <!-- 商品名 -->
            <div class="form-group">
                <label for="name">商品名</label>
                <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}" required>
            </div>

            <!-- ブランド名 -->
            <div class="form-group">
                <label for="brand_name">ブランド名</label>
                <input type="text" id="brand_name" name="brand_name" placeholder="ブランド名を入力" value="{{ old('brand_name') }}">
            </div>

            <!-- 商品の説明 -->
            <div class="form-group">
                <label for="description">商品の説明</label>
                <textarea id="description" name="description" rows="5"
                    placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            </div>

            <!-- 販売価格 -->
            <div class="form-group">
                <label for="price">販売価格</label>
                <input type="number" id="price" name="price" placeholder="価格を入力" value="{{ old('price') }}" required>
            </div>

            <!-- 出品ボタン -->
            <button type="submit" class="btn-submit">出品する</button>
        </form>
    </div>
@endsection
