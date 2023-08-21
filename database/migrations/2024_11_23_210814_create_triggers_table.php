<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // DB::unprepared('CREATE TRIGGER bind_profiles AFTER INSERT ON `users` FOR EACH ROW BEGIN INSERT INTO `profiles` (`id`, `name`, `primary_email`, `user_id`) VALUES (uuid(), NEW.name, NEW.email, NEW.id); END;');
    }

    public function down(): void
    {
        // DB::unprepared('DROP TRIGGER `bind_profiles`');
    }
};
