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
        Schema::create('offering_letters', function (Blueprint $table) {
            $table->id();
            $table->char('interview_score_id', 36)->nullable();
            $table->unsignedBigInteger('primary_salary')->nullable();
            $table->unsignedBigInteger('secondary_salary')->nullable();
            $table->string('placement')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->boolean('has_changed')->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->char('created_by', 36)->nullable()->index();
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->char('updated_by', 36)->nullable()->index();
            $table->softDeletes();
            $table->char('deleted_by', 36)->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offering_letters');
    }
};
