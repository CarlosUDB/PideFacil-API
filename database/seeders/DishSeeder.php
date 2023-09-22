<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Dish::firstOrCreate([
            'name' => 'ANGUS GRILL (1 CARNE)',
            'picture' => 'images/bkp1.png',
            'description' => "Solo unos expertos en carne a la parrilla podían traerte la nueva Angus Grill de Originals, con el máximo sabor de la carne, hasta en la salsa. 150 gramos de 100% Angus acompañados de queso Gruyer, crujiente bacon, tomate fresco, rúcula y canónigos entre pan brioche. Tan buena que te dejará marca.",
            'price' => 11.95,
            'restaurant_id' => 1
        ]);

        Dish::firstOrCreate([
            'name' => 'SMOKY STEAKHOUSE (1 CARNE)',
            'picture' => 'images/bkp2.jpg',
            'description' => "¡La nueva versión Steakhouse is in the house! Te llegarán hasta señales de humo para que pruebes su carne a la parrilla que viene con el sabor ahumado de la nueva salsa barbacoa Bull's-Eye y el Cheddar ahumado. Entre pan brioche y acompañada de bacon crujiente, doble de cebolla crispy, mayonesa y lechuga y tomate frescos.",
            'price' => 8.50,
            'restaurant_id' => 1
        ]);

        Dish::firstOrCreate([
            'name' => 'BRUTAL BIG BANG (1 CARNE)',
            'picture' => 'images/bkp3.png',
            'description' => "¡La nueva versión Steakhouse is in the house! Te llegarán hasta señales de humo para que pruebes su carne a la parrilla que viene con el sabor ahumado de la nueva salsa barbacoa Bull's-Eye y el Cheddar ahumado. Entre pan brioche y acompañada de bacon crujiente, doble de cebolla crispy, mayonesa y lechuga y tomate frescos.",
            'price' => 9.50,
            'restaurant_id' => 1
        ]);


        Dish::firstOrCreate([
            'name' => 'Big Mac',
            'picture' => 'images/mdp1.png',
            'description' => "La perfección: dos deliciosas tortas de carne 100% de res y salsa Big Mac, entre un pan de semillas de sésamo. Se completa con pepinillos, lechuga rallada, cebolla finamente picada y queso americano para una hamburguesa con un sabor sin igual.",
            'price' => 7.50,
            'restaurant_id' => 2
        ]);

        Dish::firstOrCreate([
            'name' => 'Egg McMuffin',
            'picture' => 'images/mdp2.png',
            'description' => "Pan Muffin cubierto de mantequilla suave, una rodaja de jamón, huevo y queso cheddar amarillo.",
            'price' => 3.99,
            'restaurant_id' => 2
        ]);

        Dish::firstOrCreate([
            'name' => 'Cajita Feliz de Hamburguesa Junior',
            'picture' => 'images/mdp3.jpg',
            'description' => "Cajita Feliz incluye una deliciosa Hamburguesa Junior, una papa kid, soda o bebida natural acompañada con un puré de manzana o yogurt de fresa, y un juguete de la promoción vigente.",
            'price' => 4.25,
            'restaurant_id' => 2
        ]);

        Dish::firstOrCreate([
            'name' => 'Combo Tribu Pa2',
            'picture' => 'images/tbp1.png',
            'description' => "2 Crunchywrap Supreme + 2 Bebidas Medianas + 1 Papa Supreme.",
            'price' => 4.99,
            'restaurant_id' => 3
        ]);

        Dish::firstOrCreate([
            'name' => 'Combo Tribu Pa3',
            'picture' => 'images/tbp2.png',
            'description' => "3 Burritos 5 Capas + 1 Nachos Bellgrande + 3 Cinnamon Twists + 3 Bebidas Medianas",
            'price' => 7.99,
            'restaurant_id' => 3
        ]);

        Dish::firstOrCreate([
            'name' => 'Combo Tribu Pa4',
            'picture' => 'images/tbp3.png',
            'description' => "4 Burritos 5 Capas + 4 Burritos de Frijol + 2 Nachos Supreme + 2 Porciones de Flautas de Dulce de Leche + 4 Bebidas Medianas ",
            'price' => 9.99,
            'restaurant_id' => 3
        ]);


    }
}
