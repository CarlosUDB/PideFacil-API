<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@pidefacil.com',
            'password' => bcrypt('adminpidefacil'),
            'user_type' => 'admin' 
        ]);

        User::firstOrCreate([
            'first_name' => 'Carlos',
            'last_name' => 'Carcamo',
            'email' => 'carlos@gmail.com',
            'password' => bcrypt('12121212'),
            'address' => "McClure Cape, 66537 Schulist Drive, Alabama, Lake Effie",
            'user_type' => 'client'
        ]);

        User::firstOrCreate([
            'first_name' => 'Byron',
            'last_name' => 'Mendez',
            'email' => 'byron@gmail.com',
            'password' => bcrypt('12121212'),
            'address' => "Daniella Overpass, 89340 Colin Flats, Wyoming",
            'user_type' => 'client'
        ]);

        User::firstOrCreate([
            'first_name' => 'Oscar',
            'last_name' => 'Garcia',
            'email' => 'oscar@gmail.com',
            'password' => bcrypt('12121212'),
            'user_type' => 'manager',
            'restaurant_id' => 1
        ]);

        User::firstOrCreate([
            'first_name' => 'Daniel',
            'last_name' => 'Perez',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('12121212'),
            'user_type' => 'manager',
            'restaurant_id' => 2
        ]);

        User::firstOrCreate([
            'first_name' => 'Antonio',
            'last_name' => 'Hernandez',
            'email' => 'antonio@gmail.com',
            'password' => bcrypt('12121212'),
            'user_type' => 'manager',
            'restaurant_id' => 3
        ]);

        


    }
}
