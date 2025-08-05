<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique(); // SKU should be unique
            $table->string('category');
            $table->decimal('price', 8, 2); // Best practice for currency
            $table->unsignedInteger('stock');
            $table->string('img')->nullable(); // Image path, nullable
            $table->text('description')->nullable();
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};