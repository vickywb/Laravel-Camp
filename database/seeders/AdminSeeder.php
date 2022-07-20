<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@lara.camp',
            'password' => Hash::make('secret'),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'is_admin' => true,
        ]);

        $admin->userProfile()->create([
            'address' => 'jl.jeruk',
            'phone_number' => '12345678'
        ]);
    }
}
