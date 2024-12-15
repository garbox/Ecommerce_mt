<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Cart;
use App\Models\ProductAttribute;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cart::Class)->references('id')->on('carts');
            $table->foreignIdFor(ProductAttribute::Class)->references('id')->on('product_attributes');
            $table->timestamp('created_at')->useCurrent();         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_attributes');
    }
};
