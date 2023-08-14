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
        Schema::create('vacancy_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('initial')->default('B');
            $table->string('slug')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('vacancy_types')->insert([
            ['name' => 'Freelance', 'slug' => 'freelance', 'initial' => 'D'],
            ['name' => 'Internship', 'slug' => 'internship', 'initial' => 'C'],
            ['name' => 'Part-time', 'slug' => 'part-time', 'initial' => 'B'],
            ['name' => 'Full-time', 'slug' => 'full-time', 'initial' => 'A'],
            ['name' => 'Contract', 'slug' => 'contract', 'initial' => 'B'],
            ['name' => 'Project', 'slug' => 'project', 'initial' => 'B']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_types');
    }
};
