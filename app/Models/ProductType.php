<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProductAttribute;

class ProductType extends Model
{

    public function typename(int $id){
        return ProductType::find($id);
    }    
    public function productattributes():HasMany

    {
        return $this->hasMany(ProductAttribute::class);
    }
}
