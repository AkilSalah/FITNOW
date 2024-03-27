<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\progression>
 */
class progressionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userId' => function(){
                return \App\Models\User::factory()->create()->id;
            },
            'poids' => $this->faker->numberBetween(50, 100),
            'Poitrine' => $this->faker->numberBetween(80, 120),
            'Mollet' => $this->faker->numberBetween(20, 40),
            'Bras' => $this->faker->numberBetween(20, 40),
            'Hauteur' => $this->faker->numberBetween(150, 200),
            'PoidsLeve' => $this->faker->numberBetween(20, 50),
            'TempsDeCourse' => $this->faker->numberBetween(10, 60),
            'status' => 'NonTerminé',
        ];
    }
}
