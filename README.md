# CoachTech Marketplace

CoachTech Marketplace は、商品一覧、詳細表示、ユーザー認証機能、いいね機能、コメント機能などを備えたマーケットプレイスアプリケーションです。

## 🛠️ 使用技術

- **フレームワーク**: Laravel 10
- **データベース**: MySQL
- **フロントエンド**: Blade, CSS
- **認証**: Laravel Fortify
- **アイコン**: Font Awesome

---

## 🌟 主な機能

1. **ユーザー認証**
   - 会員登録、ログイン、ログアウト機能を提供。
   - 未認証ユーザーは一部のアクションにアクセスできません。

2. **商品一覧ページ**
   - 商品の一覧を表示。
   - 商品名や画像をクリックすると詳細ページに遷移。

3. **商品詳細ページ**
   - 商品の詳細情報（名前、価格、状態、いいね数、コメント数など）を表示。
   - 認証済みユーザーのみいいねボタンやコメント投稿が可能。

4. **いいね機能**
   - 認証済みユーザーは商品のいいねを追加または解除可能。
   - 未認証ユーザーがいいねを押すとログインページにリダイレクト。

5. **コメント機能**
   - 認証済みユーザーのみコメントが投稿可能。

---

## 🚀 セットアップ手順

1. **リポジトリをクローン**
   git clone https://github.com/your-repo/coachtech-marketplace.git
   cd coachtech-marketplace

2. **必要なパッケージをインストール**
   composer install
   npm install

3. **環境ファイルを設定**
   `.env.example` をコピーして `.env` を作成し、以下を設定:
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass

4. **データベースのセットアップ**
   php artisan migrate --seed

5. **ストレージリンクを作成**
   php artisan storage:link

6. **ローカルサーバーを起動**
   php artisan serve

   ブラウザで [http://localhost:8000](http://localhost:8000) を開いて確認します。

## 📂 主なディレクトリ構成

├── app/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── ItemController.php
│   │   └── LikeController.php
│   ├── Models/
│       ├── Item.php
│       ├── Like.php
│       └── User.php
├── database/
│   ├── migrations/
│   ├── seeders/
│       └── ItemsTableSeeder.php
├── public/
│   ├── images/
│   └── storage/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── items/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   └── auth/
│   │       ├── login.blade.php
│   │       └── register.blade.php
│   ├── css/
│       ├── common.css
│       ├── index.css
│       └── show.css
├── routes/
│   └── web.php

---

## 📝 今後の課題

- 支払い機能（StripeやPayPalの統合）。
- 商品検索機能の高度化。
- レスポンシブデザインの改善。
- カテゴリ機能の拡張。

---

## 🤝 貢献

バグ報告や機能提案は [Issues](https://github.com/your-repo/coachtech-marketplace/issues) からお願いします！

---

## 📄 ライセンス

このプロジェクトは [MIT ライセンス](LICENSE) のもとで公開されています。
