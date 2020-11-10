<?php

namespace Database\Factories;

use App\Models\Poem;
use App\Models\Stanza;
use Illuminate\Database\Eloquent\Factories\Factory;

class StanzaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stanza::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'poem_id' => Poem::factory(),
            'order' => $this->faker->randomNumber(),
        ];
    }
}
