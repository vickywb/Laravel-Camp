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
                'title' => 'Learning Code Addicted',
                'slug' => 'learning-code-addicted',
                'price' => 300,
                // 'created_at' => date('Y-m-d H:i:s', time()),
                // 'updated_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'title' => 'New Member',
                'slug' => 'new-member',
                'price' => 150,
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
