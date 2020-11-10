<?php

namespace Database\Factories;

use App\Models\Line;
use App\Models\Stanza;
use Illuminate\Database\Eloquent\Factories\Factory;

class LineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Line::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stanza_id' => Stanza::factory(),
            'content' => $this->faker->words(6, true),
            'alignment' => $this->faker->optional(0.25, 'center')->randomElement(['left', 'right']),
            'order' => $this->faker->randomNumber(),
        ];
    }
}
