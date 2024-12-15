<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductAttribute extends Model
{
    // relationships
    public function producttype():HasOne
    {
        return $this->hasone(ProductType::class);
    }
}
