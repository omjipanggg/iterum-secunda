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
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('proposal_id')->cascadeOnUpdate()->noActionOnDelete()->constrained('proposals');
            $table->unsignedTinyInteger('interview_sequence', 3)->nullable()->default(1);
            $table->date('interview_date');
            $table->time('interview_time');
            $table->string('interview_type');
            $table->string('interview_location');
            $table->text('description');
            $table->string('person_in_charge');
            $table->string('phone_number');
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
        Schema::dropIfExists('interview_schedules');
    }
};
