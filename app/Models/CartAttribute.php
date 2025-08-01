<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Cart;
use App\Models\ProductAttribute;


class CartAttribute extends Model
{
    protected $fillable = ['product_attribute_id', 'cart_id'];

    public function cart(): HasOne
    {
        return $this->hasone(Cart::class);
    }

    public function product_attribute(): HasOne
    {
        return $this->hasone(ProductAttribute::class);
    }
}
