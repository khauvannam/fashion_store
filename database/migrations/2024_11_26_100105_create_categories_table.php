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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // Automatically creates an auto-incrementing 'id' field
            $table->string('name');  // 'name' field
            $table->text('description')->nullable();  // 'description' field
            $table->foreignId('parent_id')->nullable()->constrained('categories');  // 'parent_id' field, references categories
            $table->timestamps();  // 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};