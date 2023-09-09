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
        Schema::create('file_profiles', function (Blueprint $table) {
            $table->id();
            $table->char('profile_id', 36)->nullable()->index();
            $table->unsignedBigInteger('file_category_id')->nullable()->index();
            $table->string('name');
            $table->unsignedBigInteger('size')->nullable()->default(0);
            $table->string('extension')->nullable();
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
        Schema::dropIfExists('file_profiles');
    }
};
