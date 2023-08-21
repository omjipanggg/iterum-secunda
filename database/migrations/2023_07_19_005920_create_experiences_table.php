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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('profile_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('profiles');
            $table->unsignedBigInteger('city_id')->nullable()->index();
            // $table->foreignId('city_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('cities');
            $table->string('company_name');
            $table->string('job_title');
            $table->text('job_description')->nullable();
            $table->date('starting_date');
            $table->date('ending_date')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_contact')->nullable();
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
        Schema::dropIfExists('experiences');
    }
};
