<?php

use App\Models\User;
use Database\Seeders\CountrySeeder;
use Database\Seeders\StateSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();
        $this->call([
            CitySeeder::class,
            CountrySeeder::class,
            StateSeeder::class
        ]);
    }
}
