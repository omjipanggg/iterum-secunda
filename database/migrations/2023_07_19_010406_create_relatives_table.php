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
        Schema::create('relatives', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('profile_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('profiles');
            $table->foreignId('close_relation_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('close_relations');
            $table->string('national_number')->nullable();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->foreignId('education_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('education');
            $table->string('occupation')->nullable();
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
        Schema::dropIfExists('relatives');
    }
};
