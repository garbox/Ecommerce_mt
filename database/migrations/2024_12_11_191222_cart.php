<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->references('id')->on('products');
            $table->string('token_id');
            $table->integer('quantity')->default(1);
            $table->timestamp('created_at')->useCurrent();    
            $table->timestamp('updated_at')->useCurrent();     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
