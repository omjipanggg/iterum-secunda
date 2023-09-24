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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->string('description')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('active')->default(0);
            $table->unsignedBigInteger('read_count')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('created_by', 36)->nullable()->index();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('updated_by', 36)->nullable()->index();
            $table->softDeletes();
            $table->char('deleted_by', 36)->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
