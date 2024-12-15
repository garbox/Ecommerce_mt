<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['status' => 'Queue'],
            ['status' => 'Milling'],
            ['status' => 'Production'],
            ['status' => 'Sanding'],
            ['status' => 'Fninishing'],
            ['status' => 'Pending Shipping'],
            ['status' => 'Shipped'],
            ['status' => 'Delivered'],
        ]);
    }
}
