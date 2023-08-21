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
            $table->char('project_id', 36);
            $table->foreignId('job_title_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('job_titles');
            $table->string('name')->nullable();
            $table->string('placement')->nullable();
            $table->text('qualification')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->date('opening_date');
            $table->date('closing_date');
            $table->unsignedBigInteger('min_limit')->nullable();
            $table->unsignedBigInteger('max_limit')->nullable();
            $table->char('template_id', 36)->index();
            $table->boolean('active')->default(0);
            $table->boolean('hidden_partner')->default(0);
            $table->boolean('hidden_placement')->default(0);
            $table->foreignId('vacancy_type_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('vacancy_types');
            $table->string('slug');
            $table->char('region_id', 36)->index();
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('vacancies');
    }
};
