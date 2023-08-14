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
        Schema::create('profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('national_number');
            $table->string('card_number')->nullable();
            $table->string('family_number')->nullable();
            $table->string('healthcare_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('gender')->index();
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('current_address');
            $table->string('national_address');
            $table->unsignedBigInteger('city')->index();
            $table->unsignedTinyInteger('marital_status')->nullable()->index();
            $table->unsignedTinyInteger('blood_type')->nullable()->index();
            $table->unsignedTinyInteger('ready_to_work')->nullable();
            $table->unsignedBigInteger('expected_salary')->default(0);
            $table->string('expected_facility')->nullable();
            $table->string('resume');
            $table->text('motivation');
            $table->string('picture')->default('default.webp')->nullable();
            $table->foreignUuid('user_id')->cascadeOnUpdate()->constrained('users');
            $table->string('alternate_email')->nullable();
            $table->string('phone_number');
            $table->date('joined_date')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('profiles');
    }
};
