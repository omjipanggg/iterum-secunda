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
        Schema::create('partners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->char('prefix', 3)->nullable();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->char('region_id', 36)->nullable()->index();
            // $table->foreignId('city_id')->cascadeOnUpdate()->noActionOnDelete()->nullable()->constrained('cities');
            $table->string('address')->nullable();
            $table->string('person_in_charge')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website')->nullable();
            $table->year('established_year')->nullable();
            $table->string('field')->nullable();
            $table->unsignedBigInteger('total_employees')->nullable();
            $table->text('description')->nullable();
            $table->string('picture')->default('landscape.webp')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('active')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('created_by', 36)->nullable()->index();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('updated_by', 36)->nullable()->index();
            $table->softDeletes();
            $table->char('deleted_by', 36)->nullable()->index();
        });

        DB::table('partners')->insert([
            'id' => '00000000-0000-0000-0000-000000000000',
            'name' => '000-Mitra-000-Kosong',
            'prefix' => 'MKS',
            'city_id' => 155,
            'address' => 'Jl. Bahagia No.4',
            'person_in_charge' => '-',
            'phone_number' => '-',
            'established_year' => '2010',
            'total_employees' => '100',
            'slug' => '000-mitra-000-kosong',
            'active' => 1,
            'status' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
