<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::firstOrCreate(
            ['name' => 'Burger King']
        );

        Restaurant::firstOrCreate(
            ['name' => 'Subway']
        );
    }
}
