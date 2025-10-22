<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Unique Identifiers
            $table->string('sku')->unique();
            $table->json('translation')->nullable();
            $table->string('barcode')->nullable();
            $table->decimal('original_price', 10, 2);
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->boolean('is_sale')->default(false);
            $table->integer('stock_quantity')->default(0);
            $table->decimal('tax_rate', 5, 2)->nullable();
            $table->boolean('is_taxable')->default(true);
            $table->string('unit')->default('pcs');
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->nullOnDelete();
            $table->string('cover_img')->nullable();
            $table->json('tags')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->timestamp('synced_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unique(['category_id', 'product_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('category_product');
    }
};
