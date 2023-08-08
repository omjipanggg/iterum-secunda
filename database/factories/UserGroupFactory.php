<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Role;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $menus = Menu::pluck('id')->toArray();
        $roles = Role::pluck('id')->toArray();
        return [
            'menu_id' => fake()->randomElement($menus),
            'role_id' => fake()->randomElement($roles),
        ];
    }
}
