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
        Schema::create('contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('offering_letter_id')->nullable()->index();
            $table->string('header_number')->nullable();
            $table->string('initial_card_number')->nullable();
            $table->foreignUuid('employee_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('employees');
            $table->foreignId('department_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('departments');
            $table->unsignedBigInteger('take_home_pay')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->string('document')->nullable();
            $table->unsignedBigInteger('generated_count')->default(0)->nullable();
            $table->unsignedTinyInteger('status')->default(0)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('contracts');
    }
};
