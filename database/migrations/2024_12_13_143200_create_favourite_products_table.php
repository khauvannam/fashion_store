<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favourite_products', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // 'product_id' field, references products
            $table->primary(['user_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favourite_products');
    }
};
