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
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('project_number')->nullable();
            $table->string('name')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->char('partner_id', 36)->default('00000000-0000-0000-0000-000000000000')->nullable()->index();
            $table->string('person_in_charge')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->boolean('active')->default(0);
            $table->string('document')->nullable();
            $table->text('description')->nullable();
            $table->string('slug');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('projects')->insert([
            'id' => '00000000-0000-0000-0000-000000000000',
            'project_number' => '000-BELUM-000-DISESUAIKAN',
            'name' => 'Belum Disesuaikan',
            'starting_date' => '2023-01-01',
            'ending_date' => '2025-12-31',
            'person_in_charge' => '-',
            'phone_number' => '-',
            'status' => 1,
            'active' => 1,
            'slug' => '000-belum-000-disesuaikan'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
