<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->realText(280),
            'edited' => $this->faker->boolean(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
