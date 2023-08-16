<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Region;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->jobTitle();
        $projects = Project::pluck('id')->toArray();
        $regions = Region::pluck('id')->toArray();
        return [
            'header_number' => fake()->numerify('DIR-KP/PKWT-#/HQ-JBT'),
            'job_title_id' => fake()->numberBetween(1, 13),
            'name' => $name,
            'project_id' => fake()->randomElement($projects),
            'placement' => fake()->city(),
            'qualification' => fake()->sentence(100),
            'description' => fake()->sentence(100),
            'quantity' => fake()->randomDigitNotNull(),
            'opening_date' => fake()->dateTimeBetween('-2 weeks', '+1 week'),
            'closing_date' => fake()->dateTimeBetween('-1 week', '+2 weeks'),
            'template_id' => fake()->uuid(),
            'region_id' => fake()->randomElement($regions),
            'active' => true,
            'hidden_partner' => fake()->boolean(),
            'hidden_placement' => fake()->boolean(),
            'vacancy_type_id' => fake()->numberBetween(1, 6),
            'slug' => Str::slug($name) . '-' . fake()->randomNumber(6, true),
            'published_at' => fake()->dateTimeBetween('-1 week', 'now'),
            'created_by' => '00000000-0000-0000-0000-000000000000',
            'updated_by' => '00000000-0000-0000-0000-000000000000'
        ];
    }
}
