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
        Schema::create('interview_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('interview_schedule_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('interview_schedules');
            $table->string('header_number')->nullable();
            $table->unsignedTinyInteger('personality')->nullable();
            $table->unsignedTinyInteger('comperhension')->nullable();
            $table->unsignedTinyInteger('linguistics')->nullable();
            $table->unsignedTinyInteger('teamwork')->nullable();
            $table->unsignedTinyInteger('leadership')->nullable();
            $table->unsignedTinyInteger('computer_basic')->nullable();
            $table->unsignedTinyInteger('computer_advance')->nullable();
            $table->unsignedTinyInteger('work_motivation')->nullable();
            $table->unsignedTinyInteger('work_knowledge')->nullable();
            $table->unsignedTinyInteger('interest_in_work')->nullable();
            $table->unsignedTinyInteger('suitability')->nullable();
            $table->string('placement_to_be')->nullable();
            $table->unsignedBigInteger('first_salary')->nullable();
            $table->unsignedBigInteger('second_salary')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->unsignedTinyInteger('percentage')->nullable();
            $table->text('private_notes')->nullable();
            $table->text('reason')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('interview_scores');
    }
};
