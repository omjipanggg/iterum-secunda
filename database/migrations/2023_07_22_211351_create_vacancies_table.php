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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('header_number');
            $table->foreignId('job_title_id')->cascadeOnUpdate()->constrained('job_titles');
            $table->char('project_id', 36)->index();
            $table->string('placement');
            $table->text('qualification');
            $table->text('description');
            $table->unsignedBigInteger('quantity')->default(1);
            $table->date('opening_date');
            $table->date('closing_date');
            $table->char('template', 36)->index();
            $table->unsignedTinyInteger('active')->default(0);
            $table->boolean('hidden_partner')->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignUuid('created_by')->cascadeOnUpdate()->constrained('users');
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignUuid('updated_by')->cascadeOnUpdate()->constrained('users');
            $table->softDeletes();
            $table->foreignUuid('deleted_by')->cascadeOnUpdate()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
