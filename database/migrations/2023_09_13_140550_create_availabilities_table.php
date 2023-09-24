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
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table("availabilities")->insert([
            ['name' => 'SEGERA'],
            ['name' => 'DALAM SATU MINGGU'],
            ['name' => 'DALAM 1 - 3 MINGGU'],
            ['name' => 'DALAM SATU BULAN'],
            ['name' => 'DALAM 1 - 3 BULAN'],
            ['name' => 'KONFIRMASI DAHULU']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
