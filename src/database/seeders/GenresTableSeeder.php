<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'genre_name' => '寿司',
        ];
        DB::table('genres')->insert($param);
        $param = [
            'id' => 2,
            'genre_name' => '焼肉',
        ];
        DB::table('genres')->insert($param);
        $param = [
            'id' => 3,
            'genre_name' => '居酒屋',
        ];
        DB::table('genres')->insert($param);
        $param = [
            'id' => 4,
            'genre_name' => 'イタリアン',
        ];
        DB::table('genres')->insert($param);
        $param = [
            'id' => 5,
            'genre_name' => 'ラーメン',
        ];
        DB::table('genres')->insert($param);
    }
}
