<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert product and get its ID
        $productId = DB::table('products')->insertGetId([
            'name' => "Walnut Night Stand",
            'short_description' => "This is a short description of product",
            'long_description' => "This is a long description of product",
            'product_type_id' => 1,
            'price'=> 299,
        ]);

        // Insert photo linked to product
        DB::table('photos')->insert([
            'product_id' => $productId,
            'filename' => 'walnut_nightstand.png',
            'order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
