<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    public function carts():HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public static function updateProduct(Request $request) {
        $product = Product::find($request->productId);
        $product->name = $request->productName;
        $product->short_description = $request->shortDescription;
        $product->long_description = $request->longDescription;
        $product->price = $request->productPrice;
        $product->product_type_id = $request->productCategory;

        if($request->productImage !=null){
            $product->img = $request->productImage;
        }
        
        $product->save(); 
    }

    //relationship

    public function type(): BelongsTo{
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }
}
