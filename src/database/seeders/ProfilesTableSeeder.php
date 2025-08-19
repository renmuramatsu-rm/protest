<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'user_id' => 1,
            'postcode' => '111-2222',
            'address' => '東京都千代田区',
            'building' => 'オフィスビル',
        ];
        Profile::create($param);

        $param = [
            'user_id' => 2,
            'postcode' => '222-3333',
            'address' => '大阪府天王寺',
            'building' => '大阪ビル',
        ];
        Profile::create($param);

        $param = [
            'user_id' => 3,
            'postcode' => '333-4444',
            'address' => '北海道北区',
            'building' => '札幌ビル',
        ];
        Profile::create($param);
    }
}
