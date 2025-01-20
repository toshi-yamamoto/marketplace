<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'name' => '腕時計',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => 15000,
                'brand_name' => 'アルマーニ',
                'item_image' => 'item_images/clock.jpg',
                'condition' => '良好',
                'category' =>'アクセサリー',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HDD',
                'price' => 5000,
                'brand_name' => 'Toshiba',
                'description' => '高速で信頼性の高いハードディスク',
                'item_image' => 'item_images/hdd.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => '電化製品',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '玉ねぎ3束',
                'price' => 300,
                'brand_name' => '',
                'description' => '新鮮な玉ねぎ3束のセット',
                'item_image' => 'item_images/onion.jpg',
                'condition' => 'やや傷や汚れあり',
                'category' => '食品',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '革靴',
                'price' => 4000,
                'brand_name' => 'Regal',
                'description' => 'クラシックなデザインの革靴',
                'item_image' => 'item_images/shoes.jpg',
                'condition' => '状態が悪い',
                'category' => '衣服',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ノートPC',
                'price' => 45000,
                'brand_name' => 'NEC',
                'description' => '高性能なノートパソコン',
                'item_image' => 'item_images/notepc.jpg',
                'condition' => '良好',
                'category' => '電化製品',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'マイク',
                'price' => 8000,
                'brand_name' => 'Bose',
                'description' => '高音質のレコーディング用マイク',
                'item_image' => 'item_images/mic.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => '音楽',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'brand_name' => 'Gucci',
                'description' => 'おしゃれなショルダーバッグ',
                'item_image' => 'item_images/bag.jpg',
                'condition' => 'やや傷や汚れあり',
                'category' => '衣服',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'タンブラー',
                'price' => 500,
                'brand_name' => 'Kinto',
                'description' => '使いやすいタンブラー',
                'item_image' => 'item_images/tumbler.jpg',
                'condition' => '状態が悪い',
                'category' => '日用品',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'コーヒーミル',
                'price' => 4000,
                'brand_name' => '',
                'description' => '手動のコーヒーミル',
                'item_image' => 'item_images/coffeemil.jpg',
                'condition' => '良好',
                'category' => '日用品',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'メイクセット',
                'price' => 2500,
                'brand_name' => 'Kanebo',
                'description' => '便利なメイクアップセット',
                'item_image' => 'item_images/makeup.jpg',
                'condition' => '目立った傷や汚れなし',
                'category' => '美容',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
