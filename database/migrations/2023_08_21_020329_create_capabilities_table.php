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
        Schema::create('capabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('skills');
            $table->foreignUuid('profile_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('profiles');
            $table->unsignedTinyInteger('rate')->nullable();
            $table->string('certificate')->nullable();
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
        Schema::dropIfExists('capabilities');
    }
};
