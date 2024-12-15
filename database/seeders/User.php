<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Some User',
            'city' => 'Make Believe',
            'phone' => '1234567890',
            'state' => '1',
            'zip' => '90210',
            'address' => '1 Main Street',
            'email' => 'user@email.com',
            'role_id' => 2,
            'password' => Hash::make('123ABC'),
            
        ]);

        DB::table('users')->insert([
            'name' => 'Some Admin',
            'city' => 'Admin Land',
            'phone' => '1234567890',
            'state' => '1',
            'zip' => '90210',
            'address' => '1 Admin Ave.',
            'email' => 'admin@email.com',
            'role_id' => 1,
            'password' => Hash::make('123ABC'),
            
        ]);
    }
}
