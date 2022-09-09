<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Kakashi Uzumaki',
            'email' => 'email@email.com',
            'password' => Hash::make('secret'),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'role' => User::ROLE_MEMBER,
        ]);

        $user->userProfile()->create([
            'address' => 'jl.jeruk purut',
            'phone_number' => '12345678'
        ]);

        $user1 = User::create([
            'name' => 'Hyuga Kojiro',
            'email' => 'hyuga@email.com',
            'password' => Hash::make('secret'),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'role' => User::ROLE_MEMBER,
        ]);

        $user1->userProfile()->create([
            'address' => 'jl.jeruk nutrisari',
            'phone_number' => '12345678'
        ]);
    }
}
