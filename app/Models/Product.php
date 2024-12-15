<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Cart;

class Product extends Model
{
    public function carts():HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
