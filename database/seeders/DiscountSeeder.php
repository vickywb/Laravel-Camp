<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discounts = [
            [
                'title' => 'New Member',
                'code' => 'NEWBIE',
                'type' => 'percentage',
                'amount' => 20
            ],
            [
                'title' => 'Middle Dev',
                'code' => 'MIDDEV',
                'type' => 'fixed',
                'amount' => 50.000
            ],
            [
                'title' => 'Senior Dev',
                'code' => 'SENDEV',
                'type' => 'percentage',
                'amount' => 30
            ],
        ];

        foreach ($discounts as $discount) {
            Discount::create($discount);
        }
    }
}
