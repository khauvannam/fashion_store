<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('category_filters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->json('sort_data')->nullable(); // To store JSON data
            $table->json('sort_size')->nullable(); // To store JSON data
            $table->json('colors')->nullable();    // To store JSON data
            $table->json('collections')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_filters');
    }
};
