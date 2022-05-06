<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'website' => $this->faker->domainName,
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
