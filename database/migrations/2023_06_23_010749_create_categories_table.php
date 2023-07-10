<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->char('created_by', 36)->default('00000000-0000-0000-0000-000000000000')->nullable();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->char('updated_by', 36)->default('00000000-0000-0000-0000-000000000000')->nullable();
            $table->softDeletes();
            $table->char('deleted_by', 36)->nullable();
        });

        DB::table('categories')->insert([
            ['name' => 'food', 'slug' => 'food'],
            ['name' => 'beverage', 'slug' => 'beverage'],
            ['name' => 'ngodeng', 'slug' => 'ngodeng'],
            ['name' => 'vegan', 'slug' => 'vegan'],
            ['name' => 'healthy', 'slug' => 'healthy'],
            ['name' => 'cheap', 'slug' => 'cheap'],
            ['name' => 'spicy', 'slug' => 'spicy'],
            ['name' => 'kids', 'slug' => 'kids']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
