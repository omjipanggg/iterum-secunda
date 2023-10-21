<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('created_by', 36)->nullable()->index();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('updated_by', 36)->nullable()->index();
            $table->softDeletes();
            $table->char('deleted_by', 36)->nullable()->index();
        });

        DB::table('templates')->insert([
            'id' => '00000000-0000-0000-0000-000000000000',
            'name' => 'TEMPLATE_PKWT_2023.odt',
            'created_by' => '00000000-0000-0000-0000-000000000000',
            'updated_by' => '00000000-0000-0000-0000-000000000000'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
