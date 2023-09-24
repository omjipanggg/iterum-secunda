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
        Schema::create('file_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('file_categories')->insert([
            ['name' => 'CV (Curriculum Vitae)'],
            ['name' => 'Kartu Tanda Penduduk (KTP)'],
            ['name' => 'Kartu Keluarga (KK)'],
            ['name' => 'Surat Izin Mengemudi (SIM)'],
            ['name' => 'Surat Kepolisian (SKCK)'],
            ['name' => 'Ijazah (Pendidikan)'],
            ['name' => 'Akta Kelahiran'],
            ['name' => 'Sertifikat'],
            ['name' => 'Paspor'],
            ['name' => 'Pas Foto'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_categories');
    }
};
