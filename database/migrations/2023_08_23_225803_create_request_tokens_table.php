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
        Schema::create('request_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('hash')->unique();
            $table->string('department_name')->nullable();
            $table->foreignUuid('region_id')->nullable()->cascadeOnUpdate()->noActionOnDelete()->constrained('regions');
            $table->boolean('completed')->default(0);
            $table->dateTime('expired_at')->default('2025-12-31 23:59:59');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_tokens');
    }
};
