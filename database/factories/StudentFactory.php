<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'address'=> $this->faker->address,
            'phone'=> $this->faker->phoneNumber,
            'birthday'=> $this->faker->date,
            'image'=> $this->faker->image,
            'slug' => $this->faker->slug,
        ];
    }
}
