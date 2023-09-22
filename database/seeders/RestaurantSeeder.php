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
        
        Restaurant::firstOrCreate([
                'name' => 'Burger King',
                'logo' => 'images/burger_king.png'
            ]);

        Restaurant::firstOrCreate([
            'name' => 'McDonalds',
            'logo' => 'images/mcdonalds.png'
        ]);

        Restaurant::firstOrCreate([
            'name' => 'Taco Bel',
            'logo' => 'images/taco_bell.png'
        ]);
        
    }
}
