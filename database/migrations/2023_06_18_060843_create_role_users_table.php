<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_users', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->cascadeOnUpdate()->constrained();
            $table->foreignId('role_id')->cascadeOnUpdate()->constrained();
            $table->dateTime('expire_date')->default('2023-12-31 23:59:59');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        DB::table('role_users')->insert([
            'user_id' => '00000000-0000-0000-0000-000000000000',
            'role_id' => 1, 'expire_date' => '2049-12-31 23:59:59'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
