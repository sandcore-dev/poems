<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->optional(0.25, '')->randomElement(['Lord', 'Lady', 'Sir', 'Dame']),
            'first_name' => $this->faker->firstName,
            'middle_names' => $this->faker->optional(0.25, '')->firstName,
            'last_name' => $this->faker->lastName,
            'birth_year' => $this->faker->optional()->year,
            'deceased_year' => $this->faker->optional()->year,
            'slug' => function (array $attributes) {
                return Str::slug("{$attributes['first_name']} {$attributes['middle_names']} {$attributes['last_name']}");
            },
        ];
    }
}
