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
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('years')->insert([
            ['name' => '1971'], ['name' => '1972'], ['name' => '1973'], ['name' => '1974'],
            ['name' => '1975'], ['name' => '1976'], ['name' => '1977'], ['name' => '1978'],
            ['name' => '1979'], ['name' => '1980'], ['name' => '1981'], ['name' => '1982'],
            ['name' => '1983'], ['name' => '1984'], ['name' => '1985'], ['name' => '1986'],
            ['name' => '1987'], ['name' => '1988'], ['name' => '1989'], ['name' => '1990'],
            ['name' => '1991'], ['name' => '1992'], ['name' => '1993'], ['name' => '1994'],
            ['name' => '1995'], ['name' => '1996'], ['name' => '1997'], ['name' => '1998'],
            ['name' => '1999'], ['name' => '2000'], ['name' => '2001'], ['name' => '2002'],
            ['name' => '2003'], ['name' => '2004'], ['name' => '2005'], ['name' => '2006'],
            ['name' => '2007'], ['name' => '2008'], ['name' => '2009'], ['name' => '2010'],
            ['name' => '2011'], ['name' => '2012'], ['name' => '2013'], ['name' => '2014'],
            ['name' => '2015'], ['name' => '2016'], ['name' => '2017'], ['name' => '2018'],
            ['name' => '2019'], ['name' => '2020'], ['name' => '2021'], ['name' => '2022'],
            ['name' => '2023'], ['name' => '2024'], ['name' => '2025'], ['name' => '2026'],
            ['name' => '2027'], ['name' => '2028'], ['name' => '2029'], ['name' => '2030']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('years');
    }
};
