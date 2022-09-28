<?php

namespace Database\Seeders;

use App\Models\CampBenefit;
use Illuminate\Database\Seeder;

class CampBenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campBenefits = [
            [
                'camp_id' => 1,
                'name' => 'Pro Techstack kit'
            ],
            [
                'camp_id' => 1,
                'name' => 'Introduce The Program'
            ],
            [
                'camp_id' => 1,
                'name' => '1-1 Mentoring Program'
            ],
            [
                'camp_id' => 1,
                'name' => 'Final Project Certificate'
            ],
            [
                'camp_id' => 1,
                'name' => 'Offline Course Video'
            ],
            [
                'camp_id' => 1,
                'name' => 'Future Job Oppurtunity'
            ],
            [
                'camp_id' => 2,
                'name' => 'Premium Design Kit'
            ],
            [
                'camp_id' => 2,
                'name' => 'Website Builder'
            ],
            [
                'camp_id' => 2,
                'name' => '1-1 Mentoring Program'
            ],
            [
                'camp_id' => 2,
                'name' => 'Offline Course Video'
            ],
            [
                'camp_id' => 2,
                'name' => 'Final Project Certificate'
            ],
            [
                'camp_id' => 2,
                'name' => 'Representation your program to mentor'
            ],
            [
                'camp_id' => 2,
                'name' => 'Future Job Oppurtunity'
            ],
            [
                'camp_id' => 3,
                'name' => 'Profesional Design Kit'
            ],
            [
                'camp_id' => 3,
                'name' => 'Website Builder'
            ],
            [
                'camp_id' => 3,
                'name' => '1-1 Mentoring Program'
            ],
            [
                'camp_id' => 3,
                'name' => 'Offline Course Video'
            ],
            [
                'camp_id' => 3,
                'name' => 'Final Project Certificate'
            ],
            [
                'camp_id' => 3,
                'name' => 'Representation your program to mentor'
            ],
            [
                'camp_id' => 3,
                'name' => 'Future Job Oppurtunity'
            ],
            [
                'camp_id' => 3,
                'name' => 'Final Exam with mentor'
            ],
        ];

        foreach ($campBenefits as $campBenefit) {
            CampBenefit::create($campBenefit);
        }
    }
}
