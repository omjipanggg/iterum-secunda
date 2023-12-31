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
        Schema::create('categories_and_products', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('product_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('products');
            $table->foreignId('product_category_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('product_categories');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_and_products');
    }
};
