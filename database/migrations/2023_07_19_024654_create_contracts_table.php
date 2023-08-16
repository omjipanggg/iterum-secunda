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
            $table->string('header_number')->nullable();
            $table->string('initial_card_number')->nullable();
            $table->foreignUuid('employee_id')->nullable()->cascadeOnUpdate()->constrained('employees');
            $table->unsignedBigInteger('generated_count')->default(0)->nullable();
            $table->foreignId('department_id')->nullable()->cascadeOnUpdate()->constrained('departments');
            $table->unsignedBigInteger('salary')->nullable();
            $table->date('started_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->string('document')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('contracts');
    }
};
