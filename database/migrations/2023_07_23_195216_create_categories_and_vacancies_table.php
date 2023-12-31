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
        Schema::create('categories_and_vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('vacancy_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('vacancies');;
            $table->foreignId('vacancy_category_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('vacancy_categories');
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
        Schema::dropIfExists('categories_and_vacancies');
    }
};
