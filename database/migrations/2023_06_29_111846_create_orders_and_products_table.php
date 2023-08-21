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
        Schema::create('orders_and_products', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('order_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('orders');
            $table->foreignUuid('product_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('products');
            $table->unsignedBigInteger('quantity')->default(0);
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
        Schema::dropIfExists('orders_and_products');
    }
};
