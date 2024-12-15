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
            'name' => "Walnut Table",
            'short_description' => "This is a short description of product",
            'long_description' => "This is a long description of product",
            'product_type_id' => 1,
            'price'=> 699,
            'img' => 'randomImg'
        ]);

        DB::table('products')->insert([
            'name' => "Walnut Night Stand",
            'short_description' => "This is a short description of product",
            'long_description' => "This is a long description of product",
            'product_type_id' => 2,
            'price'=> 299,
            'img' => 'randomImg'
        ]);

        DB::table('products')->insert([
            'name' => "Walnut Credenza",
            'short_description' => "This is a short description of product",
            'long_description' => "This is a long description of product",
            'product_type_id' => 3,
            'price'=> 1600,
            'img' => 'randomImg'
        ]);
    }
}
