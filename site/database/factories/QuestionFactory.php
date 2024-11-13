<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        [
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            'deleted_at' => $deletedAt,
        ] = $this->getCreationDates();

        return [
            'name' => $this->faker->words(asText: true),
            'is_enabled' => $this->faker->boolean(),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            'deleted_at' => $deletedAt,
        ];
    }

    /**
     * Gets creation dates.
     */
    public function getCreationDates(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-5 years', '-1 years');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, (clone $createdAt)->add(\DateInterval::createFromDateString('4 day')));
        $deletedAt = null;
        if ($this->faker->boolean(20)) {
            $deletedAt = $this->faker->dateTimeBetween($updatedAt, '-1 years');
        }

        return [
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            'deleted_at' => $deletedAt,
        ];
    }
}
