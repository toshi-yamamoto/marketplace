<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name' => 'サンプル商品',
            'description' => 'これはサンプルの商品説明です。',
            'brand_name' => 'サンプルブランド',
            'price' => 9999.99,
            'condition' => '良好',
            'category' => 'サンプルカテゴリ',
            'user_id' => 1, // ユーザーIDを指定
        ]);
    }
}
