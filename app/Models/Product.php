<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['name', 'short_description', 'price', 'product_type_id', 'long_description'];
    public static function updateProduct(Request $request)
    {
        $product = Product::find($request->productId);
        $product->name = $request->productName;
        $product->short_description = $request->shortDescription;
        $product->long_description = $request->longDescription;
        $product->price = $request->productPrice;
        $product->product_type_id = $request->productCategory;

        if ($request->productImage != null) {
            $product->img = $request->productImage;
        }

        $product->save();
    }

    //relationship
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('order');
    }

    public function mainPhoto()
    {
        return $this->hasOne(Photo::class)->where('order', 1);
    }
}
