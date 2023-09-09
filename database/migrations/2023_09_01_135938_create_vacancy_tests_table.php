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
        Schema::create('vacancy_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('vacancy_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('vacancies');
            $table->string('name')->nullable()->default('Tes Umum');
            $table->unsignedTinyInteger('limitation')->nullable()->default(5);
            $table->unsignedTinyInteger('duration')->nullable()->default(5);
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->string('unique_number')->nullable();
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
        Schema::dropIfExists('vacancy_tests');
    }
};
