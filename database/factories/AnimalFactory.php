<?php

namespace Database\Factories;

use App\Models\AnimalType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = AnimalType::inRandomOrder()->first();
        $breed = $type->breeds->random();

        return [
            'name' => $this->faker->firstName,
            'age' => $this->faker->numberBetween(1, 15),
            'animal_type_id' => $type->id,
            'animal_breed_id' => $breed->id,
            'description' => $this->faker->sentence,
            'price_ttc' => $this->faker->numberBetween(50000, 200000),
            'price_ht' => $this->faker->numberBetween(50000, 200000),
            'status' => $this->faker->randomElement(['available', 'sold']),
        ];
    }
}
