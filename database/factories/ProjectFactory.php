<?php

namespace Database\Factories;

use App\Models\Partner;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $partners = Partner::pluck('id')->toArray();
        return [
            'project_number' => fake()->numerify('PRJ-KAM-####'),
            'name' => $name,
            'starting_date' => fake()->dateTimeBetween('-2 weeks', '+1 week'),
            'ending_date' => fake()->dateTimeBetween('-1 week', '+2 weeks'),
            'partner_id' => fake()->randomElement($partners),
            'person_in_charge' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'status' => 1,
            'active' => 1,
            'slug' => Str::slug($name),
            'document' => 'document.pdf'
        ];
    }
}
