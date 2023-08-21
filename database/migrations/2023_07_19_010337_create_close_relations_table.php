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
        Schema::create('close_relations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('close_relations')->insert([
            ['name' => 'Ayah'],
            ['name' => 'Ibu'],
            ['name' => 'Anak'],
            ['name' => 'Suami'],
            ['name' => 'Istri'],
            ['name' => 'Kakak'],
            ['name' => 'Adik'],
            ['name' => 'Sepupu'],
            ['name' => 'Keponakan'],
            ['name' => 'Paman/Bibi']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('close_relations');
    }
};
