<?php

namespace Database\Seeders;

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
        $this->call([
            AdminSeeder::class,
            CampSeeder::class,
            CampBenefitSeeder::class,
            UserSeeder::class,
            DiscountSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
