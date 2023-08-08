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
            $table->string('header_number')->nullable();
            $table->foreignUuid('project_id')->cascadeOnUpdate()->constrained('projects');
            $table->foreignId('job_title_id')->cascadeOnUpdate()->constrained('job_titles');
            $table->string('name')->nullable();
            $table->string('placement')->nullable();
            $table->text('qualification')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->date('opening_date');
            $table->date('closing_date');
            $table->char('template', 36)->index();
            $table->boolean('active')->default(0);
            $table->boolean('hidden_partner')->default(0);
            $table->boolean('hidden_placement')->default(0);
            $table->foreignId('vacancy_type_id')->cascadeOnUpdate()->constrained('vacancy_types');
            $table->string('slug');
            $table->dateTime('published_at')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignUuid('created_by')->cascadeOnUpdate()->constrained('users');
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignUuid('updated_by')->cascadeOnUpdate()->constrained('users');
            $table->softDeletes();
            $table->foreignUuid('deleted_by')->nullable()->cascadeOnUpdate()->constrained('users');
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
