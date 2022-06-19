<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            "name" => "Herrod Fuentes",
            "phone" => 10844645898
        ]);

        Customer::create([
            "name" => "Len Castillo",
            "phone" => 113818706
        ]);

        Customer::create([
            "name" => "Octavius Riggs",
            "phone" => 169772035
        ]);

        Customer::create([
            "name" => "Alyssa Warner",
            "phone" => 169773426
        ]);

        Customer::create([
            "name" => "Brenna Aguirre",
            "phone" => 1580011189
        ]);
    }
}
