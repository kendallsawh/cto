<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\App;
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
        if (App::environment(['local', 'testing'])) {
            $this->call([
                ConcessionStatusSeeder::class,
                MeasurementUnitSeeder::class,
                ItemCategorySeeder::class,
                ItemsSeeder::class,
                ConcessionsDemoSeeder::class,
            ]);
        }
    }
}
