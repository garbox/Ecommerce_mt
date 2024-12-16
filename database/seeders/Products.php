<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => "Walnut Night Stand",
            'short_description' => "This is a short description of product",
            'long_description' => "This is a long description of product",
            'product_type_id' => 1,
            'price'=> 299,
            'img' => 'walnut_nightstand.png'
        ]);
    }
}
