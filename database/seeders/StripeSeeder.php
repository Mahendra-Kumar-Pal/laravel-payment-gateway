<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StripeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'stripe',
                'email' => 'stripe@gmail.com',
                'password' => 'password'
            ],
        ];

        foreach ($data as $key => $value) {
            \App\Models\User::create([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => bcrypt($value['password']),
            ]);
        }
    }
}
