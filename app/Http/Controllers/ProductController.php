<?php

namespace App\Http\Controllers;
use App\Models\ProductAttribute;
use App\Models\Product;

class ProductController extends Controller
{
    //product index
    public function show(int $id){  
        $prod = Product::where('id', $id)->first();
        $attributes = ProductAttribute::all();

        $finish = $attributes->where('product_type_id', $prod->product_type_id)
            ->where('category', 'finish')
            ->select('id', 'attribute', 'category', 'price');

        $legs = $attributes->where('category', 'legs')
            ->where('product_type_id', $prod->product_type_id)
         ->select('id', 'attribute', 'category', 'price');

        $size = $attributes->where('category', 'size')
            ->where('product_type_id', $prod->product_type_id)
            ->select('id', 'attribute', 'category', 'price');
        

        return view('/product', ['prod' => $prod, 'finish'=> $finish, 'size'=> $size, 'legs' => $legs]);
        
    }
}
