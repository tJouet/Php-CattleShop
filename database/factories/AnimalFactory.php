<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Animal;
use App\Models\User;
use App\Types\AnimalType;
use App\Types\AnimalStatus;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    protected $model = Animal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'age' => $this->faker->numberBetween(1, 15),
            'type' => $this->faker->randomElement(AnimalType::cases()),
            'race' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 500),
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(AnimalStatus::cases()),
            'owner_id' => User::inRandomOrder()->first()->id,
            // 'image' => $faker->image('public/storage/images',640,480, null, false),
        ];
    }
}
