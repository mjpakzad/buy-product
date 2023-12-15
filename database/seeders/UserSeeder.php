<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'first_name' => 'Mojtaba',
            'last_name' => 'Pakzad',
            'email' => 'work.pakzad@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '09123456789',
            'mobile_verified_at' => now(),
            'password' => bcrypt('p@s$W0rd'),
            'credit' => 50000,
        ];
        User::query()->create($user);
    }
}
