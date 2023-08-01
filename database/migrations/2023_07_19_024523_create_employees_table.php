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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('card_number');
            $table->string('national_number');
            $table->string('family_number')->nullable();
            $table->string('healthcare_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('gender')->index();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->date('joined_date')->nullable();
            $table->string('phone_number');
            $table->string('current_address');
            $table->string('national_address');
            $table->string('current_email');
            $table->unsignedTinyInteger('marital_status')->nullable();
            $table->unsignedTinyInteger('blood_type')->nullable();
            $table->string('picture')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->foreignUuid('user_id')->cascadeOnUpdate()->constrained('users');
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
        Schema::dropIfExists('employees');
    }
};
