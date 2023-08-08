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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('education')->insert([
            ['name' => 'Laisnnya'],
            ['name' => 'Tidak ada'],
            ['name' => 'SD'],
            ['name' => 'SMP'],
            ['name' => 'SMA'],
            ['name' => 'SMK'],
            ['name' => 'D1'],
            ['name' => 'D2'],
            ['name' => 'D3'],
            ['name' => 'D4'],
            ['name' => 'S1'],
            ['name' => 'S2'],
            ['name' => 'S3'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
