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
            'price' => 55.99,
            
        ]); 

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "finish",
            'attribute' => "gloss",
            'price' => 59.99,
            
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "size",
            'attribute' => '15" x 13"',
            'price' => 100,
            
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "size",
            'attribute' => '15" x 15"',
            'price' => 120,
            
        ]);

        DB::table('product_attributes')->insert([
            'product_type_id' => 1,
            'category' => "size",
            'attribute' => '16"x16"',
            'price' => 130,
            
        ]); 
    }
}
