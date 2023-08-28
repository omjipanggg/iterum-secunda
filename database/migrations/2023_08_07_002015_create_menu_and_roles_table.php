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
        Schema::create('menu_and_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->cascadeOnUpdate()->noActionOnDelete()->constrained('menu');
            $table->foreignId('role_id')->cascadeOnUpdate()->noActionOnDelete()->constrained('roles');
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
        Schema::dropIfExists('menu_and_roles');
    }
};
