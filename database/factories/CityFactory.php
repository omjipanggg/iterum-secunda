<?php

namespace Database\Factories;


use App\Models\Province;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provinces = Province::pluck('id')->toArray();
        return [
            'name' => fake()->city(),
            'province_id' => fake()->randomElement($provinces),
        ];
    }
}
