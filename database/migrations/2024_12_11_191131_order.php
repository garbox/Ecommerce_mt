<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Status;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('total_price');
            $table->foreignIdFor(Status::class)->references('id')->on('statuses');
            $table->foreignIdFor(User::class)->references('id')->on('users');
            $table->timestamp('created_at')->useCurrent();    
            $table->timestamp('updated_at')->useCurrent(); 
        });

        DB::statement("ALTER TABLE orders AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
