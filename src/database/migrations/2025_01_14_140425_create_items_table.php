<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); // 商品名 (varchar(255))
            $table->text('description'); // 商品説明 (text)
            $table->string('brand_name', 255); // ブランド名 (varchar(255))
            $table->decimal('price', 10, 2); // 価格 (decimal(10,2))
            $table->enum('condition', ['良好', '目立った傷や汚れなし', 'やや傷や汚れあり', '状態が悪い']); // 商品状態 (enum)
            $table->string('category', 255); // カテゴリ (varchar(255))
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID (unsigned bigint, 外部キー)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
