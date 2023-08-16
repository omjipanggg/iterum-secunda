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
        Schema::create('candidates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('profile_id')->cascadeOnUpdate()->constrained('profiles');
            $table->string('ready_to_work')->nullable();
            $table->unsignedBigInteger('expected_salary')->default(0)->nullable();
            $table->string('expected_facility')->nullable();
            $table->string('resume')->nullable();
            $table->text('motivation')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->nullable();
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
        Schema::dropIfExists('candidates');
    }
};
