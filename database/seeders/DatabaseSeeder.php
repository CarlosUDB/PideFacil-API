<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //calling the seeders
        $this->call([
            RestaurantSeeder::class,
            UserSeeder::class,
        ]);
    }
}
