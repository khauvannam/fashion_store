<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // Automatically creates an auto-incrementing 'id' field
            $table->string('name');  // 'name' field
            $table->decimal('price', 10);  // 'price' field, 10 digits with 2 decimal places
            $table->decimal('discountPercent', 5)->nullable();  // 'discountPercent' field, nullable
            $table->text('description')->nullable();  // 'description' field, nullable
            $table->json('imageUrls')->nullable();  // 'imageUrls' field, stored as a JSON array
            $table->foreignId('category_id')->constrained('categories');  // 'category_id' field, references categories
            $table->timestamps();  // 'created_at' and 'updated_at' timestamps
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
