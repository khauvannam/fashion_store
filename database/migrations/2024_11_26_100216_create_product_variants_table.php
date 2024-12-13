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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();  // Automatically creates an auto-incrementing 'id' field
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // 'product_id' field, references products
            $table->decimal('price_override', 10, 2)->nullable();  // 'price_override' field, nullable
            $table->string('image_override')->nullable();
            $table->integer('quantity')->default(0);  // 'quantity' field with default 0
            $table->json('attribute_values')->nullable();  // 'attribute_values' field, stored as a JSON array
            $table->timestamps();  // 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
