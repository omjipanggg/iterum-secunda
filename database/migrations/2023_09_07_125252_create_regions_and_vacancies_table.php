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
        Schema::create('regions_and_vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('vacancy_id')->cascadeOnUpdate()->noActionOnDelete()->constrained('vacancies');
            $table->foreignUuid('region_id')->cascadeOnUpdate()->noActionOnDelete()->constrained('regions');
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
        Schema::dropIfExists('regions_and_vacancies');
    }
};
