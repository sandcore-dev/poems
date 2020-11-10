<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Poem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PoemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Poem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => Author::factory(),
            'title' => $this->faker->sentence,
            'slug' => function (array $attributes) {
                return Str::slug($attributes['title']);
            },
        ];
    }
}
