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
        Schema::create('regions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nulable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('regions')->insert([
            ['code' => '01', 'name' => 'Serikat', 'slug' => 'serikat', 'description' => 'Kolom ini sengaja dikosongkan.'],
            ['code' => '02', 'name' => 'Jabodetabek', 'slug' => 'jbt', 'description' => 'Jakarta, Bogor, Depok, Tangerang dan Bogor.'],
            ['code' => '03', 'name' => 'Jawa Barat', 'slug' => 'jbr', 'description' => 'Jabar.'],
            ['code' => '04', 'name' => 'Jawa Tengah', 'slug' => 'jtg', 'description' => 'Jateng.'],
            ['code' => '05', 'name' => 'Jawa Timur', 'slug' => 'jtm', 'description' => 'Jatim.'],
            ['code' => '06', 'name' => 'Bali dan Nusa Tenggara', 'slug' => 'bns', 'description' => 'Balinusra.'],
            ['code' => '07', 'name' => 'Kalimantan', 'slug' => 'kal', 'description' => 'Kalimantan dan sekitarnya.'],
            ['code' => '08', 'name' => 'Sulawesi', 'slug' => 'smj', 'description' => 'Sulawesi, Makassar dan Irian Jaya.'],
            ['code' => '09', 'name' => 'Sumatera Utara', 'slug' => 'sbt', 'description' => 'Sumbagut.'],
            ['code' => '10', 'name' => 'Sumatera Selatan', 'slug' => 'sbs', 'description' => 'Sumbagsel.'],
            ['code' => '11', 'name' => 'Sumatera Barat', 'slug' => 'sbb', 'description' => 'Sumbagbar.'],
            ['code' => '12', 'name' => 'Sumatera Timur', 'slug' => 'sbt', 'description' => 'Sumbagtim.'],
            ['code' => '13', 'name' => 'Papua dan Maluku', 'slug' => 'pma', 'description' => 'PUMAAA.'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
