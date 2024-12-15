<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdAttribute extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "finish",
            'attribute' => "matte",
            'price' => 49.99,
            
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "finish",
            'attribute' => "satin",
            'price' => 52.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "finish",
            'attribute' => "gloss",
            'price' => 55.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "legs",
            'attribute' => "hair pin",
            'price' => 85.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "legs",
            'attribute' => "square",
            'price' => 200.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "legs",
            'attribute' => "farm house",
            'price' => 350.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "legs",
            'attribute' => "post",
            'price' => 150.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "legs",
            'attribute' => "trapizoid",
            'price' => 250.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "size",
            'attribute' => "6x3",
            'price' => 120.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "size",
            'attribute' => "6x3.5",
            'price' => 150.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "size",
            'attribute' => "6x4",
            'price' => 170.99,
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "size",
            'attribute' => "6x4.5",
            'price' => 180.99,
        ]);
    }
}
