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
        Schema::create('last_education', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('profile_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('profiles');
            $table->foreignId('education_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('education');
            $table->foreignId('higher_education_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('higher_educations');
            $table->foreignId('education_field_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('education_fields');
            $table->unsignedBigInteger('city_id')->nullable()->index();
            // $table->foreignId('city_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('cities');
            $table->year('graduation_year')->nullable();
            $table->unsignedDecimal('cgpa')->nullable();
            $table->string('certificate')->nullable();
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
        Schema::dropIfExists('last_education');
    }
};
