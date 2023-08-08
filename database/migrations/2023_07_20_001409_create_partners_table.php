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
        Schema::create('partners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->char('prefix', 3)->nullable();
            $table->unsignedBigInteger('city')->index();
            $table->string('address');
            $table->string('person_in_charge');
            $table->string('phone_number');
            $table->string('website')->nullable();
            $table->year('established_year')->nullable();
            $table->string('field')->nullable();
            $table->unsignedBigInteger('total_employees')->nullable();
            $table->text('description')->nullable();
            $table->string('picture')->default('landscape.png')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('active')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('partners');
    }
};
