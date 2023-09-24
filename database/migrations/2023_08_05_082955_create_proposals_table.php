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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('candidate_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('candidates');
            $table->foreignUuid('vacancy_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('vacancies');
            $table->string('resume')->nullable();
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->nullable();
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
        Schema::dropIfExists('proposals');
    }
};
