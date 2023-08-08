<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        return [
            'name' => $name,
            'prefix' => fake()->regexify('[A-F]{3}'),
            'city' => fake()->numberBetween(37, 82),
            'address' => fake()->address(),
            'person_in_charge' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'established_year' => fake()->numberBetween(2001, 2019),
            'total_employees' => fake()->numberBetween(54, 3291),
            'description' => fake()->text(120),
            'slug' => Str::slug($name),
            'active' => 1,
            'status' => 1,
            'created_by' => '00000000-0000-0000-0000-000000000000',
            'updated_by' => '00000000-0000-0000-0000-000000000000'
        ];
    }
}
