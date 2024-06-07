<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminAndShopOwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin1234'),
            'role_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 店舗責任者を作成
        $numberOfShopOwners = 20;

        for ($i = 0; $i < $numberOfShopOwners; $i++) {
            // ランダムなユーザー情報を生成して保存
            DB::table('users')->insert([
                'name' => 'ShopOwner' . $i,
                'email' => 'shopowner' . $i . '@example.com',
                'password' => Hash::make('password123'), // パスワードをハッシュ化
                'role_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
