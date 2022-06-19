<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Seeder;

class MealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meal::create([
            "price" => 115,
            "description" => 'Taco Salad',
            'quantity_available'=> 10,
            'discount_percentage'=> 5
        ]);

        Meal::create([
            "price" => 145,
            "description" => 'Grilled Chicken',
            'quantity_available'=> 15,
            'discount_percentage'=> 2
        ]);

        Meal::create([
            "price" => 255,
            "description" => 'Beef Teriyaki',
            'quantity_available'=> 10,
            'discount_percentage'=> 0
        ]);

        Meal::create([
            "price" => 65,
            "description" => 'Chicken Soup',
            'quantity_available'=> 20,
            'discount_percentage'=> 1
        ]);

        Meal::create([
            "price" => 155,
            "description" => 'Steak & Mushroom Pasta',
            'quantity_available'=> 10,
            'discount_percentage'=> 3
        ]);

        Meal::create([
            "price" => 200,
            "description" => 'Seafood Pasta',
            'quantity_available'=> 10,
            'discount_percentage'=> 0
        ]);

        Meal::create([
            "price" => 100,
            "description" => 'Margherita Pizza',
            'quantity_available'=> 10,
            'discount_percentage'=> 0
        ]);

        Meal::create([
            "price" => 125,
            "description" => 'BBQ Chicken Pizza',
            'quantity_available'=> 10,
            'discount_percentage'=> 0
        ]);

        Meal::create([
            "price" => 150,
            "description" => 'Smoked Salmon Sandwich',
            'quantity_available'=> 7,
            'discount_percentage'=> 0
        ]);

        Meal::create([
            "price" => 35,
            "description" => 'Ice Cream',
            'quantity_available'=> 15,
            'discount_percentage'=> 0
        ]);
    }
}
