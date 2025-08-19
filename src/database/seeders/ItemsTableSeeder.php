<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'user_id'      => 1,
            'name'         => '腕時計',
            'brandname'    => 'casio',
            'price'        => '15000',
            'description'  => 'スタイリッシュなデザインのメンズ腕時計',
            'image'        => 'products/時計.jpg',
            'condition_id' => 1,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 1,
            'name'         => 'HDD',
            'brandname'    => 'sony',
            'price'        => '5000',
            'description'  => '高速で信頼性の高いハードディスク',
            'image'        => 'products/HDD.jpg',
            'condition_id' => 2,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 1,
            'name'         => '玉ねぎ3束',
            'brandname'    => '淡路島',
            'price'        => '300',
            'description'  => '新鮮な玉ねぎ3束のセット',
            'image'        => 'products/玉ねぎ３束.jpg',
            'condition_id' => 3,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 1,
            'name'         => '革靴',
            'brandname'    => 'nike',
            'price'        => '4000',
            'description'  => 'クラシックなデザインの革靴',
            'image'        => 'products/革靴.jpg',
            'condition_id' => 4,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 1,
            'name'         => 'ノートPC',
            'brandname'    => 'lenovo',
            'price'        => '4500',
            'description'  => '高性能なノートパソコン',
            'image'        => 'products/パソコン.jpg',
            'condition_id' => 1,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 2,
            'name'         => 'マイク',
            'brandname'    => 'ノーマル',
            'price'        => '8000',
            'description'  => '高音質マイクのレコーディング用',
            'image'        => 'products/マイク.jpg',
            'condition_id' => 2,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 2,
            'name'         => 'ショルダーバッグ',
            'brandname'    => 'gucci',
            'price'        => '3500',
            'description'  => 'おしゃれなショルダーバッグ',
            'image'        => 'products/バッグ.jpg',
            'condition_id' => 3,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 2,
            'name'         => 'タンブラー',
            'brandname'    => 'buruno',
            'price'        => '500',
            'description'  => '使いやすいタンブラー',
            'image'        => 'products/タンブラー.jpg',
            'condition_id' => 4,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 2,
            'name'         => 'コーヒーミル',
            'brandname'    => 'karita',
            'price'        => '300',
            'description'  => '手動のコーヒーミル',
            'image'        => 'products/コーヒーミル.jpg',
            'condition_id' => 1,
        ];
        DB::table('items')->insert($param);
        $param = [
            'user_id'      => 2,
            'name'         => 'メイクセット',
            'brandname'    => '資生堂',
            'price'        => '2500',
            'description'  => '便利なメイクアップセット',
            'image'        => 'products/メイクアップセット.jpg',
            'condition_id' => 2,
        ];
        DB::table('items')->insert($param);

    }
}
