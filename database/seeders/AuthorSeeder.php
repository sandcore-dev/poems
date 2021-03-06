<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Language;
use App\Models\Line;
use App\Models\Poem;
use App\Models\Stanza;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::factory()
            ->count(25)
            ->for(Language::factory())
            ->has(
                Poem::factory()
                    ->count(rand(5, 15))
                    ->has(
                        Stanza::factory()
                            ->count(rand(1, 5))
                            ->has(
                                Line::factory()
                                    ->count(rand(2, 6))
                            )
                    )
            )
            ->create();
    }
}
