<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    //product index
    public function show(int $id)
    {
        $product = Product::with('photos', 'type.productattributes')->find($id);
        if (!$product) {
            abort(404, 'Product not found');
        }
        $group = $product->type->productattributes->groupBy('category');
        return view('/product', ['prod' => $product, 'group' => $group]);
    }
}
