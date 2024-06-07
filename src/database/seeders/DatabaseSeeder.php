<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(AdminAndShopOwnersSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ShopsTableSeeder::class);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
