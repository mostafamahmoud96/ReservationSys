<?php

namespace Database\Seeders;

use App\Models\Waiter;
use Illuminate\Database\Seeder;

class WaitersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Waiter::create([
            "name" => "Zeus Bender"
        ]);

        Waiter::create(
            [
                "name" => "Kirk Sawyer"
            ]
        );

        Waiter::create([
            "name" => "Octavius Hodge"
        ]);

        Waiter::create([
            "name" => "Jasper Pena"
        ]);
        
        Waiter::create([
            "name" => "Kennan Barlow"
        ]);
    }
}
