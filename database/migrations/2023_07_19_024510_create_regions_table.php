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
            [
                'id' => 'dc46669e-c640-462b-ac6f-bbf8b22e9f29',
                'code' => '01',
                'name' => 'Indonesia',
                'slug' => 'idn',
                'description' => 'Kolom ini sengaja dikosongkan.'
            ],
            [
                'id' => '6d0fb7a4-c961-4e89-9c1a-f6b730ced791',
                'code' => '02',
                'name' => 'Jabodetabek',
                'slug' => 'jbt',
                'description' => 'Jakarta, Bogor, Depok, Tangerang dan Bogor.'
            ],
            [
                'id' => '4514055e-8993-4c68-8a2c-8769c9d15a26',
                'code' => '03',
                'name' => 'Jawa Barat',
                'slug' => 'jbr',
                'description' => 'Jabar.'
            ],
            [
                'id' => '22b920c4-4f91-4dc0-b305-e649f856572d',
                'code' => '04',
                'name' => 'Jawa Tengah',
                'slug' => 'jtg',
                'description' => 'Jateng.'
            ],
            [
                'id' => 'becc608a-e527-4c90-8699-58adf44a1150',
                'code' => '05',
                'name' => 'Jawa Timur',
                'slug' => 'jtm',
                'description' => 'Jatim.'
            ],
            [
                'id' => '6ba58180-ddc4-4ae1-a236-5b463373429b',
                'code' => '06',
                'name' => 'Bali dan Nusa Tenggara',
                'slug' => 'bns',
                'description' => 'Balinusra.'
            ],
            [
                'id' => '0c10f0b4-feee-49a4-866c-6b9afad383b3',
                'code' => '07',
                'name' => 'Kalimantan',
                'slug' => 'kal',
                'description' => 'Kalimantan dan sekitarnya.'
            ],
            [
                'id' => '1ddddf38-fbf7-450a-93ff-06ea0de5538c',
                'code' => '08',
                'name' => 'Sulawesi',
                'slug' => 'smj',
                'description' => 'Sulawesi, Makassar dan Irian Jaya.'
            ],
            [
                'id' => '8a78aa86-59c7-49f8-91f5-9f4333bbd742',
                'code' => '09',
                'name' => 'Sumatera Utara',
                'slug' => 'sbt',
                'description' => 'Sumbagut.'
            ],
            [
                'id' => '3d0c8c90-3c01-490c-a871-53be8a93d1f2',
                'code' => '10',
                'name' => 'Sumatera Selatan',
                'slug' => 'sbs',
                'description' => 'Sumbagsel.'
            ],
            [
                'id' => '8007e027-3215-479c-b3f0-3253c95e1134',
                'code' => '11',
                'name' => 'Sumatera Barat',
                'slug' => 'sbb',
                'description' => 'Sumbagbar.'
            ],
            [
                'id' => '7ddb216c-50ec-4ac9-a6b7-2ce0eaf50224',
                'code' => '12',
                'name' => 'Sumatera Timur',
                'slug' => 'sbt',
                'description' => 'Sumbagtim.'
            ],
            [
                'id' => 'cef950f8-c35c-49c5-ad9c-c243e4852698',
                'code' => '13',
                'name' => 'Papua dan Maluku',
                'slug' => 'pma',
                'description' => 'PUMAAA.'
            ],
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
