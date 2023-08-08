<?php

namespace Database\Seeders;

use App\Models\JobTitle;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Models\Vacancy;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        JobTitle::factory(13)->create();
        Menu::factory(20)->create();
        Partner::factory(8)->create();
        Project::factory(7)->create();
        Vacancy::factory(12)->create();

        $roles = Role::all();

        Menu::all()->each(function($query) use($roles) {
            $query->roles()->attach($roles->random(rand(2, 4))->pluck('id')->toArray());
        });

        User::all()->each(function($query) use($roles) {
            $query->roles()->attach($roles->random(rand(2, 2))->pluck('id')->toArray());
        });
    }
}
