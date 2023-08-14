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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('roles')->insert([
            ['name' => 'Administrator'],
            ['name' => 'TBD'],
            ['name' => 'Bisnis'],
            ['name' => 'Keuangan'],
            ['name' => 'Personalia'],
            ['name' => 'Staff'],
            ['name' => 'Pelamar'],
            ['name' => 'Mitra'],
            ['name' => 'Lainnya']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
