<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Testing\Fakes\Fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['Receita', 'Despesa']);
        return [
            //
            'user_id' => User::factory(),
            'description' => $this->faker->sentence(),
            'category' => $this->faker->randomElement([
                'Alimentacao',
                'Transporte',
                'Lazer',
                'Outros',
            ]),
            'type' => $type,
            'price' => $this->faker->randomFloat(2, 10, 2000),
            'date' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}
