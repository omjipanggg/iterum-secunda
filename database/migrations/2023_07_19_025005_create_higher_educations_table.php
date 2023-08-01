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
        Schema::create('higher_educations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->year('established_year')->nullable();
            $table->char('grade', 1)->nullable();
            $table->char('type', 3)->nullable();
            $table->unsignedBigInteger('province')->index();
            $table->unsignedTinyInteger('city_type')->nullable()->index();
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
        Schema::dropIfExists('higher_educations');
    }
};
