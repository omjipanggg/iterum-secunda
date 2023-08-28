<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\JobTitle;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Skill;
use App\Models\VacancyCategory as Category;
use App\Models\Vacancy;
use App\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(28)->create();
        JobTitle::factory(13)->create();
        // Menu::factory(20)->create();
        Partner::factory(8)->create();
        Project::factory(7)->create();
        Skill::factory(15)->create();
        Category::factory(9)->create();
        Vacancy::factory(36)->create();

        $education = Education::where([
            ['name', '<>', 'Lainnya'],
            ['name', '<>', 'Tidak ada'],
            ['name', '<>', 'SMP'],
            ['name', '<>', 'SD']
        ])->orderBy('id')->get();
        $categories = Category::all();
        $roles = Role::all();
        $skills = Skill::all();

        /*
        Menu::all()->each(function($query) use($roles) {
            $query->roles()->attach($roles->random(rand(1, 3))->pluck('id')->toArray());
        });
        */

        User::all()->each(function($query) use($roles) {
            $query->roles()->attach($roles->random(rand(1, 3))->pluck('id')->toArray());
        });

        Vacancy::all()->each(function($query) use($categories) {
            $query->categories()->attach($categories->random(rand(1, 3))->pluck('id')->toArray());
        });

        Vacancy::all()->each(function($query) use($education) {
            $query->education()->attach($education->random(rand(1, 3))->pluck('id')->toArray());
        });

        Vacancy::all()->each(function($query) use($skills) {
            $query->skills()->attach($skills->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
