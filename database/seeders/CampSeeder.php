<?php

namespace Database\Seeders;

use App\Models\Camp;
use Illuminate\Database\Seeder;

class CampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $camps = [
            [
                'title' => 'New Member',
                'slug' => 'new-member',
                'price' => 150000,
                // 'created_at' => date('Y-m-d H:i:s', time()),
                // 'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'title' => 'Middle Coding Addicted',
                'slug' => 'middle-coding-addicted',
                'price' => 300000,
                // 'created_at' => date('Y-m-d H:i:s', time()),
                // 'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'title' => 'Senior Coding Addicted',
                'slug' => 'senior-coding-addicted',
                'price' => 500000,
                // 'created_at' => date('Y-m-d H:i:s', time()),
                // 'updated_at' => date('Y-m-d H:i:s', time())
            ]
        ];

        //1st method
        foreach ($camps as $camp) {
            Camp::create($camp);
        }

        //2nd method add manually created_at and updated_at
        // Camp::insert($camps);
    }
}
