<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_versions', function (Blueprint $table) {
            $table->timestamps();
            $table->string('reason');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // 'product_id' field, references products
            $table->unsignedInteger('version');
            $table->primary(['product_id', 'version']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_versions');
    }
};
