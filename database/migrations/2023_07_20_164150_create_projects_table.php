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
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('project_number');
            $table->string('name');
            $table->date('starting_date');
            $table->date('ending_date');
            $table->char('partner_id', 36)->index();
            $table->string('person_in_charge');
            $table->string('phone_number');
            $table->unsignedTinyInteger('status')->default(0);
            $table->boolean('active')->default(0);
            $table->string('document')->nullable();
            $table->text('description')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('projects');
    }
};
