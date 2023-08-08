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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('bi-database')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0)->nullable();
            $table->boolean('has_child')->default(0)->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->string('route')->default('login')->nullable();
            $table->string('model')->nullable();
            $table->unsignedTinyInteger('order_number')->default(0)->nullable();
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
        Schema::dropIfExists('menus');
    }
};
