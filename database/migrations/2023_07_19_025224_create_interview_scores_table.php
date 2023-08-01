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
            $table->foreignId('interview_schedule_id')->cascadeOnUpdate()->constrained('interview_schedules');
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
            $table->unsignedTinyInteger('percentage')->nullable();
            $table->text('private_notes')->nullable();
            $table->text('reason')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignUuid('created_by')->nullable()->cascadeOnUpdate()->constrained('users');
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignUuid('updated_by')->nullable()->cascadeOnUpdate()->constrained('users');
            $table->softDeletes();
            $table->foreignUuid('deleted_by')->nullable()->cascadeOnUpdate()->constrained('users');
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
