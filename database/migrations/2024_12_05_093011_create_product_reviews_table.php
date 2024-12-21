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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();  // Auto-incrementing 'id' field
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // Foreign key referencing 'products'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');;  // Foreign key referencing 'users'
            $table->integer('rating');  // 'rating' field, e.g., between 1 and 5
            $table->text('review')->nullable();  // 'review' field, nullable
            $table->timestamps();  // 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
