<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // Automatically creates an auto-incrementing 'id' field
            $table->string('name')->unique();  // 'name' field
            $table->decimal('price', 10);  // 'price' field, 10 digits with 2 decimal places
            $table->decimal('discount_percent', 5)->nullable();  // 'discountPercent' field, nullable
            $table->integer('units_sold')->default(0);  // 'unitsSold' field, default value of 0
            $table->text('description')->nullable();  // 'description' field, nullable
            $table->text('short_description')->nullable();
            $table->text('size_info')->nullable();
            $table->text('shipping_info')->nullable();
            $table->string('image');
            $table->string('sku', 40)->unique(); // 50 characters is a reasonable max length
            $table->string('collection')->nullable();  // 'name' field
            $table->foreignId('category_id')->constrained('categories');  // 'category_id' field, references categories
            $table->timestamps();  // 'created_at' and 'updated_at' timestamps

            // index
            $table->index('name');
            $table->index('collection');
            $table->index('sku');
            $table->index('discount_percent');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
