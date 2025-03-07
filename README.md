# Coachtech Marketplace

[リポジトリURL](https://github.com/toshi-yamamoto/marketplace)

## プロジェクト概要
Coachtech Marketplace は、ユーザーが商品を出品・購入できるマーケットプレイス型の Laravel アプリケーションです。  
ユーザー認証、商品一覧・詳細表示、商品出品、検索、購入、いいね、コメント機能など、多彩な機能を備え、レスポンシブ対応のデザインにより PC、タブレット、スマートフォンで快適に利用できます。

## 主な機能
- **ユーザー認証**
  - 会員登録、ログイン、ログアウト
  - メール認証（MailHog を使用）
  - プロフィール編集（画像アップロード対応）
- **商品関連機能**
  - 商品一覧、詳細表示
  - 商品出品（画像アップロード、複数カテゴリー選択、バリデーション）
  - 商品検索（部分一致検索）
  - 商品購入（支払い方法選択、配送先設定、住所変更）
- **いいね・コメント機能**
  - Ajax を利用したリアルタイムいいね反映
  - コメント投稿（バリデーション適用）
- **レスポンシブ対応**
  - PC (1400px以上)、タブレット (768px〜850px)、スマートフォン (768px以下) 向けのデザイン

## 使用技術
- **Laravel 8.83.29** (PHP フレームワーク)
- **PHP 8.1**
- **MySQL 8.0**
- **Docker** (Nginx, PHP, MySQL, phpMyAdmin, MailHog)
- **CSS** (レスポンシブデザイン対応)
- **JavaScript** (Ajax 等)
- **Laravel Fortify** (認証機能)
- **MailHog** (メール認証テスト)

## ログイン情報
- **管理者ユーザー**
  - Email: 設定していません
- **一般ユーザー**
  - Email: user1@test.com - user10@test.com
  - パスワード: 12345678

## インストール手順
1. リポジトリのクローン
   git clone https://github.com/toshi-yamamoto/marketplace
   cd marketplace

2. Docker の起動
   本プロジェクトは Docker を利用して環境が構築されています。
   プロジェクトルートにある docker/docker-compose.yml を使用して、以下のコマンドでコンテナを起動します:

   docker-compose up -d

   これにより、以下のサービスが起動します:
	•	nginx: ウェブサーバー
	•	php: Laravel アプリケーション実行環境
	•	mysql: データベースサーバー (MySQL 8.0)
	•	phpmyadmin: データベース管理ツール
	•	mailhog: メールキャプチャツール

   詳細な設定内容は、docker/docker-compose.yml ファイルをご確認ください。

3. .env ファイルの設定
   プロジェクトルートにある .env ファイルを以下の内容に更新してください。Docker 環境に合わせた設定です。

   APP_NAME=Laravel
   APP_ENV=local
   APP_KEY=base64:sU9bCnMxVEv8Qz5zO2mKXlBhyemXbeufWE6ORvctMkw=
   APP_DEBUG=true
   APP_URL=http://localhost

   LOG_CHANNEL=stack
   LOG_DEPRECATIONS_CHANNEL=null
   LOG_LEVEL=debug

   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass

   BROADCAST_DRIVER=log
   CACHE_DRIVER=file
   FILESYSTEM_DRIVER=local
   QUEUE_CONNECTION=sync
   SESSION_DRIVER=file
   SESSION_LIFETIME=120

   MEMCACHED_HOST=127.0.0.1

   REDIS_HOST=127.0.0.1
   REDIS_PASSWORD=null
   REDIS_PORT=6379

   MAIL_MAILER=smtp
   MAIL_HOST=mailhog
   MAIL_PORT=1025
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS=no-reply@example.com
   MAIL_FROM_NAME="${APP_NAME}"

   AWS_ACCESS_KEY_ID=
   AWS_SECRET_ACCESS_KEY=
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=
   AWS_USE_PATH_STYLE_ENDPOINT=false

   PUSHER_APP_ID=
   PUSHER_APP_KEY=
   PUSHER_APP_SECRET=
   PUSHER_APP_CLUSTER=mt1

   MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
   MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

4. マイグレーションとシーディングの実行
   Docker コンテナ内で Artisan コマンドを実行します。たとえば、以下のコマンドを実行してください:

   docker-compose exec app php artisan migrate --seed

   ※ app は PHP コンテナの名前です（docker-compose.yml に合わせて変更してください）。

5. ストレージのシンボリックリンク作成
   docker-compose exec app php artisan storage:link

6. アプリケーションの動作確認

   ブラウザで http://localhost にアクセスし、トップページが表示されることを確認してください。

   Docker コンテナ内での作業
	   •	コンテナ内に入る場合:
      docker-compose exec app bash

      これで PHP コンテナ内のシェルに入ることができ、そこで Artisan コマンドやその他の作業を行えます。

	   •	ログの確認:
      Docker コンテナのログを確認する場合は、以下のコマンドを利用してください:
      docker-compose logs -f

## ディレクトリ構成
/src
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── AuthController.php
│   │   │   ├── ItemController.php
│   │   │   ├── UserController.php
│   │   │   ├── LikeController.php
│   │   │   ├── CommentController.php
│   │   │   └── PurchaseController.php
│   ├── Models
│   │   ├── Item.php
│   │   ├── User.php
│   │   ├── Like.php
│   │   ├── Comment.php
│   │   └── Purchase.php
├── database
│   ├── migrations
│   └── seeders
├── resources
│   ├── views
│   │   ├── layouts
│   │   │   └── app.blade.php
│   │   ├── items
│   │   │   ├── index.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── create.blade.php
│   │   ├── users
│   │   │   ├── profile.blade.php
│   │   │   └── mypage.blade.php
│   ├── css
│   │   ├── common.css
│   │   ├── index.css
│   │   ├── show.css
│   │   ├── create-item.css
│   │   └── profile.css
├── routes
│   └── web.php
├── docker
│   └── docker-compose.yml
└── .env

## ER図
+-----------------+                   +-----------------+
|     users       |                   |     items       |
+-----------------+                   +-----------------+
| id (PK)         |                   | id (PK)         |
| name            |                   | name            |
| email           |                   | description     |
| password        |                   | brand_name      |
| profile_image   |                   | price           |
| postal_code     |                   | condition       |
| address         |                   | category (JSON) |
| building_name   |                   | item_image      |
| ...             |                   | user_id (FK)    |
| created_at      |                   | created_at      |
| updated_at      |                   | updated_at      |
| ...             |                   | ...             |
+-----------------+                   +-----------------+
   1 |--------------------∞               |
     |                                     |
     |                                     |
     |              +----------------------+
     |              |  item belongsTo user
     |
+-----------------+   hasMany            +-----------------+
|    comments     | <-------------------> |    likes       |
+-----------------+                      +-----------------+
| id (PK)         |                      | id (PK)         |
| content         |                      | user_id (FK)    |
| user_id (FK)    |                      | item_id (FK)    |
| item_id (FK)    |                      | created_at      |
| created_at      |                      | updated_at      |
| updated_at      |                      +-----------------+
+-----------------+
  ∞ |    belongsTo user
    |    belongsTo item
    |
    |
+-----------------+
|   purchases     |
+-----------------+
| id (PK)         |
| user_id (FK)    |
| item_id (FK)    |
| payment_method  |
| address         |
| created_at      |
| updated_at      |
+-----------------+
∞ belongsTo user
1 belongsTo item

## 開発環境
	•	Docker により、Nginx、PHP、MySQL、phpMyAdmin、MailHog の各サービスが管理され、簡単に環境構築および運用が可能です。
	•	コンテナ内での作業も可能なので、Artisan コマンドの実行やログの確認も容易です。

## その他の情報
	•	認証機能 は Laravel Fortify により実装されています。
	•	メール認証 は MailHog を利用してテスト環境で確認できます。
	•	Ajax を利用したいいね機能 や レスポンシブ対応のデザイン など、ユーザー体験向上のための工夫が施されています。