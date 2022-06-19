<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Table::create([
            "capacity" => 10,
        ]);

        Table::create([
            "capacity" => 15,
        ]);

        Table::create([
            "capacity" => 7,
        ]);

        Table::create([
            "capacity" => 2,
        ]);

        Table::create([
            "capacity" => 9,
        ]);

        Table::create([
            "capacity" => 8,
        ]);

        Table::create([
            "capacity" => 2,
        ]);

        Table::create([
            "capacity" => 5,
        ]);

        Table::create([
            "capacity" => 6,
        ]);

        Table::create([
            "capacity" => 8,
        ]);

        Table::create([
            "capacity" => 10,
        ]);
    }
}
