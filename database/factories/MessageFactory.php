<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from' => $this->faker->numberBetween(1, 12),
            'to' => $this->faker->numberBetween(1, 12),
            'msg' => $this->faker->text(200),
            'created_at' =>$this->faker->dateTimeBetween('-2 years')
        ];
    }
}
