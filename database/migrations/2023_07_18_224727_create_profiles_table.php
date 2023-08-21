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
            $table->string('national_number')->nullable();
            $table->string('family_number')->nullable();
            $table->string('healthcare_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('name')->nullable();
            $table->foreignId('gender_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('genders');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('current_address')->nullable();
            $table->string('national_address')->nullable();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            // $table->foreignId('city_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('cities');
            $table->foreignId('marital_status_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('marital_statuses');
            $table->foreignId('blood_type_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('blood_types');
            $table->string('picture')->default('default.webp')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignUuid('user_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('users');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        \DB::table('profiles')->insert([
            'id' => '00000000-0000-0000-0000-000000000000',
            'user_id' => '00000000-0000-0000-0000-000000000000',
            'name' => 'Admin',
            'primary_email' => 'omjipanggg@gmail.com'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
